<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Mail\ResetPasswordApi;
use App\Mail\ContactMail;
use App\User;
use Mail; 
use App\Service;
use App\Notification;
use App\Models\LocationModel;
use App\Models\RattingModel;
use App\Models\Contact;
class AuthController extends Controller
{
   /**
    * Get a JWT via given credentials.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function login(Request $request)
   {
        $validator = Validator::make($request->all(), [
                'email'        => 'required', 
                'password'        => 'required',   
                 
            ]);

            if ($validator->fails()) {
                $response['error']['validation'] = $validator->errors();
                return Response::json($response);
            }


       $credentials = request(['email', 'password']);
 
       if (! $token = auth()->attempt($credentials)) {
           return response()->json(['error' => 'Unauthorized'], 401);
       }
 
       return $this->respondWithToken($token);
   }
 
   /**
    * Get the authenticated User.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function me()
   {
       return response()->json(auth()->user());
   }
 
   /**
    * Log the user out (Invalidate the token).
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function logout()
   {
       auth()->logout();
 
       return response()->json(['message' => 'Successfully logged out']);
   }
 
   /**
    * Refresh a token.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function refresh()
   {
       return $this->respondWithToken(auth()->refresh());
   }
 
   /**
    * Get the token array structure.
    *
    * @param  string $token
    *
    * @return \Illuminate\Http\JsonResponse
    */
   protected function respondWithToken($token)
   {
       return response()->json([
           'access_token' => $token,
           'token_type' => 'bearer',
           'success'=>true,
           'expires_in' => auth()->factory()->getTTL() * 60
       ]);
   }

   public function sendOtp(Request $request)
   {
        $response = [];
        try {

        //valid credential
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $check = User::where('email',$request->email)->first();
        if (@$check=='') {
           $response['success'] = false;
           $response['message'] = 'User Doest Not Exists In Our Platform';
           return $response;
        }

            $update_vcode = User::where('email',$request->email)->update(['email_vcode'=>mt_rand(1111,9999)]);
            $get_vcode = User::where('email',$request->email)->first();
             $data = [
                'email'=>$request->email,
                'name'=>$get_vcode->first_name .$get_vcode->last_name ,
                'email_vcode'=>$get_vcode->email_vcode,
                'id'=>$get_vcode->id,
                
            ];
            Mail::send(new ResetPasswordApi($data));
            $response['success'] = true;
            $response['message'] = 'Otp Send To Your Email.Please Check';
            $response['user_details'] = $get_vcode;
            return $response;
        
        }catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
   }

       public function verifyOtp(Request $request)
    {
        $response = [];
        try {

        //valid credential
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $check = User::where('email_vcode',$request->otp)->first();
        if ($check=="") {
           $response['success'] = false;
           $response['message'] = 'Invalid Otp';
           return $response;
        }

        User::where('email_vcode',$request->otp)->update(['email_vcode'=>'']);
        $response['success'] = true;
        $response['message'] = 'Otp Verified Successfully';
        $response['user_details'] = $check;
        return $response;
        
        }catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Some Thing Went Wrong'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } 
    }


    public function newPassword(Request $request)
    {
        $response = [];
        try {

        //valid credential
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'password' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $password = $request->password; 
       
        $updatepassword = User::where('id',$request->user_id)->update([
            'password'=>\Hash::make($password),
        ]);

        $response['success'] = true;
        $response['message'] = 'New Password Updated Successfully';
        return $response;

        }catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Some Thing Went Wrong'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function profile()
    {
        $response = [];
        try {
          $response['success'] = true;    
          $response['user_details'] = User::where('id',auth()->user()->id)->first();
          $response['services'] = Service::where('status','!=','D')->with('location_name')->where('user_id',auth()->user()->id)->orderBy('id','desc')->get();
          $response['reviews'] = RattingModel::where('to_id',auth()->user()->id)->with('getFromUserDetails')->get();
          $response['total_review_count'] = RattingModel::where('to_id',auth()->user()->id)->count();
          $response['rating_star'] = RattingModel::where('to_id',auth()->user()->id)->avg('ratting');
          return $response;

        }catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Some Thing Went Wrong'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function profileUpdate(Request $request)
    {
        $response = [];
        try {

        //valid credential
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'ph_number' => 'required',
            'address' => 'required',
            'about' => 'required',
        ]);

        $upd = [];
        $upd['first_name'] = $request->first_name;
        $upd['last_name'] = $request->last_name;
        $upd['email'] = $request->email;
        $upd['ph_number'] = $request->ph_number;
        $upd['address'] = $request->address;
        $upd['about'] = $request->about;
        if ($request->image)
        {

        $image = $request->image;  // your base64 encoded
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(10).'.'.'png';
        \File::put(storage_path(). '/profile' . $imageName, base64_decode($image));
        $upd['image'] = 'profile'.$imageName;
        }

        User::where('id',auth()->user()->id)->update($upd);
        $response['success'] = true;
        $response['message'] = 'Profile Updated Successfully';
        return $response;



        }catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Some Thing Went Wrong'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function reviews()
    {
        $response = [];
        try {
          $response['success'] = true;    
          $response['reviews'] = RattingModel::where('to_id',auth()->user()->id)->with('getFromUserDetails')->get();
          return $response;

        }catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Some Thing Went Wrong'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function notification()
    {
        $response = [];
        try {
          $response['success'] = true;    
          $response['notification'] = Notification::orderBy('id','desc')->get();
          return $response;

        }catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Some Thing Went Wrong'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function contactUs(Request $request)
    {
       
       $response = [];
        try {

        //valid credential
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'mobile' => 'required',
        ]);  
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $ins = [];
        $ins['first_name'] = $request->first_name;
        $ins['last_name'] = $request->last_name;
        $ins['email'] = $request->email;
        $ins['mobile'] = $request->mobile;
        $ins['message'] = $request->message;
        Contact::create($ins);
        $data = [
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'mobile'=>$request->mobile,
                'message'=>$request->message,
                
            ];
        Mail::send(new ContactMail($data));
        $response['success'] = true;
        $response['message'] = 'Thank you for contacing us . We Will Get Back To Soon';
        return $response;    


        }catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Some Thing Went Wrong'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



}