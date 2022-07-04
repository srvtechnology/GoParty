<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response; 
use App\User;
use Mail;
use App\Mail\Register;
use Validator;
class UserController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
    // ftp path /var/www/beas.in/public_html/conveno
       $users = User::with('getFromLocationDetails')->get();
 
       return $users;
   }
 
   /**
    * Store a newly created resource in storage.
    *
    */
   public function store(Request $request)
   {
        $response = [];
        try{

           $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'ph_number' => 'required',
                'location' => 'required',
           ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            } 

            $check = User::where('email',$request->email)->first();
            if ($check!="") {
               $response['success'] = 'false';
               $response['message'] = 'Email Already Added.Please try another one';
               return $response;
            }

            $check2 = User::where('ph_number',$request->ph_number)->first();

            if ($check2!="") {
               $response['success'] = 'false';
               $response['message'] = 'Mobile Number Already Added.Please try another one';
               return $response;
            }

            $user = new User;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->ph_number = $request->ph_number;
            $user->location = $request->location;
            $user->save();

            // send-mail
            $data = [
               'email'=>$request->email,
               'first_name'=>$request->first_name,
               'last_name'=>$request->last_name,
            ];

            Mail::send(new Register($data));


            $response['success'] = true;
            $response['message'] = 'Registration  Successfully done';
            return $response;


        }catch(\Exception $e){
            $response['error'] = $e->getMessage();
            return Response::json($response);
        }

       // $response = [];
       // $userData = $request->all();
       // $user = User::create($userData);
       // $response['success'] = true;
       // $response['user'] = $user;  
       // return $response;
   }
}