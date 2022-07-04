<?php

namespace App\Http\Controllers\Api\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Response;
use App\Post;

class PostController extends Controller
{
    public function add(Request $request)
    {

        $distance = 100;
$earthRadius = 6371;
$lat1 = deg2rad(-26.4853239150483);
$lon1 = deg2rad(-49.075927734375);
$bearing = deg2rad(0);

$lat2 = asin(sin($lat1) * cos($distance / $earthRadius) + cos($lat1) * sin($distance / $earthRadius) * cos($bearing));
$lon2 = $lon1 + atan2(sin($bearing) * sin($distance / $earthRadius) * cos($lat1), cos($distance / $earthRadius) - sin($lat1) * sin($lat2));

echo 'LAT: ' . rad2deg($lat2) . '<br >';
echo 'LNG: ' . rad2deg($lon2);
       


        $response = [];
        try{

           $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'user_id' => 'required',
                'media' =>'required',
                'event'=>'required',
                'promote_post' =>'required',
                'user_id'=>'required',

           ]);

           //Send failed response if request is not valid
           if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
           }

           $ins = [];
           $ins['title'] = $request->title;
           $ins['description'] = $request->description; 
           $ins['promote_post'] = $request->promote_post;
           $ins['user_id'] = $request->user_id; 
           $ins['date'] = date('Y-m-d'); 
           
           if (@$request->event=="Y") {
               $ins['event'] = $request->event;
               $ins['event_location'] = $request->event_location;
               $ins['event_date'] = $request->event_date;
           }else{
                $ins['event'] = $request->event;
           }

           if ($request->hasFile('media'))
            {
             $image = $request->media;
             $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
             $image->move("storage/app/public/post",$filename);
             $ins['media'] = $filename;
            }

           Post::create($ins);
           $response['success'] = true;
           $response['message'] = 'Post Added Successfully';
           return $response; 


        }catch(\Exception $e){
            $response['error'] = $e->getMessage();
            return Response::json($response);
        } 
    }

    public function list()
    {
        $response = [];
        try{
         
         $data = Post::where('status','!=','D')->where('user_id',auth()->user()->id)->orderBy('id','desc')->get();
         $response['success'] = true;
         $response['data'] = $data;   
         $response['image_url'] = 'https://beas.in/conveno/storage/app/public/post/';
         return Response::json($response);
        
        }catch(\Exception $e){
            $response['error'] = $e->getMessage();
            return Response::json($response);
        }
    }

    public function delete($id)
    {
        $response = [];
        try{
         
         Post::where('id',$id)->update(['status'=>'D']);
         $response['success'] = true;
         $response['message'] = 'Post Deleted Successfully';   
         return Response::json($response);
        
        }catch(\Exception $e){
            $response['error'] = $e->getMessage();
            return Response::json($response);
        } 
    }


    public function edit($id)
    {
        $response = [];
        try{
         
         $data = Post::where('id',$id)->first();
         $response['success'] = true;
         $response['data'] = $data;  
         $response['image_url'] = 'https://beas.in/conveno/storage/app/public/post/';   
         return Response::json($response);
        
        }catch(\Exception $e){
            $response['error'] = $e->getMessage();
            return Response::json($response);
        }
    }

    public function update(Request $request)
    {
        $response = [];
        try{

           $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'user_id' => 'required',
                'event'=>'required',
                'promote_post' =>'required',
                'user_id'=>'required',
                'id'=>'required',
           ]);

           //Send failed response if request is not valid
           if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
           }

           $ins = [];
           $ins['title'] = $request->title;
           $ins['description'] = $request->description; 
           $ins['promote_post'] = $request->promote_post;
           $ins['user_id'] = $request->user_id; 
           
           if (@$request->event=="Y") {
               $ins['event'] = $request->event;
               $ins['event_location'] = $request->event_location;
               $ins['event_date'] = $request->event_date;
           }else{
                $ins['event'] = $request->event;
           }

           if ($request->hasFile('media'))
            {
             $image = $request->media;
             $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
             $image->move("storage/app/public/post",$filename);
             $ins['media'] = $filename;
            }

           Post::where('id',$request->id)->update($ins);
           $response['success'] = true;
           $response['message'] = 'Post Updated Successfully';
           return $response; 


        }catch(\Exception $e){
            $response['error'] = $e->getMessage();
            return Response::json($response);
        } 
    }

    public function allPost()
    {
        $response = [];
        try{
         
         $data = Post::where('status','!=','D')->where('event','N')->orderBy('id','desc')->get();
         $response['success'] = true;
         $response['data'] = $data;
         $response['image_url'] = 'https://beas.in/conveno/storage/app/public/post/';   
         return Response::json($response);
        
        }catch(\Exception $e){
            $response['error'] = $e->getMessage();
            return Response::json($response);
        }
    }

    public function allEvent()
    {
        $response = [];
        try{
         
         $data = Post::where('status','!=','D')->where('event','Y')->orderBy('id','desc')->get();
         $response['image_url'] = 'https://beas.in/conveno/storage/app/public/post/';   
         $response['success'] = true;
         $response['data'] = $data;   
         return Response::json($response);
        
        }catch(\Exception $e){
            $response['error'] = $e->getMessage();
            return Response::json($response);
        }
    }


    public function sponsoredPost()
    {
        $response = [];
        try{
         
         $data = Post::where('status','!=','D')->where('ad_enable','E')->orderBy('id','desc')->get();
         $response['success'] = true;
         $response['data'] = $data;   
         return Response::json($response);
        
        }catch(\Exception $e){
            $response['error'] = $e->getMessage();
            return Response::json($response);
        }
    }
}
