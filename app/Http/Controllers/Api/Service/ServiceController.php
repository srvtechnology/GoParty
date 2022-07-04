<?php

namespace App\Http\Controllers\Api\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Response;
use App\Service;
use App\User;
use App\Settings;
use App\Models\LocationModel;
use DB;
class ServiceController extends Controller
{
    public function addView()
    {
        $response = [];
        try{
         
         $locations = LocationModel::where('status','!=','D')->select('id','location_name')->orderBy('id','desc')->get();
         $response['success'] = true;
         $response['locations'] = $locations;   
         return Response::json($response);
        
        }catch(\Exception $e){
            $response['error'] = $e->getMessage();
            return Response::json($response);
        }
    }


    public function add(Request $request)
    {
        $response = [];
        try{

           $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'location_id' => 'required',
                'user_id' => 'required',
           ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            } 

            $service = new Service;
            $service->title = $request->title;
            $service->description = $request->description;
            $service->location_id = $request->location_id;
            $service->user_id = $request->user_id;
            $service->save();
            $response['success'] = true;
            $response['message'] = 'Service Added Successfully';
            return $response;


        }catch(\Exception $e){
            $response['error'] = $e->getMessage();
            return Response::json($response);
        }
    }

    public function listing()
    {
        $response = [];
        try{
         
         $data = Service::where('status','!=','D')->with('location_name')->where('user_id',auth()->user()->id)->orderBy('id','desc')->get();
         $response['success'] = true;
         $response['data'] = $data;   
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
         
         Service::where('id',$id)->update(['status'=>'D']);
         $response['success'] = true;
         $response['message'] = 'Service Deleted Successfully';   
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
         
         $data = Service::where('id',$id)->first();
         $response['success'] = true;
         $response['data'] = $data;  
         $response['locations'] = LocationModel::where('status','!=','D')->select('id','location_name')->orderBy('id','desc')->get(); 
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
                'location_id' => 'required',
                'user_id' => 'required',
                'id'=>'required',
           ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            } 
            $upd = [];
            $upd['title'] = $request->title;
            $upd['description'] = $request->description;
            $upd['location_id'] = $request->location_id;
            $upd['user_id'] = $request->user_id;
            Service::where('id',$request->id)->update($upd);
            
            $response['success'] = true;
            $response['message'] = 'Service Updated Successfully';
            return $response;


        }catch(\Exception $e){
            $response['error'] = $e->getMessage();
            return Response::json($response);
        }
    }


    public function allService()
    {
        $response = [];
        try{
         
         $data = Service::where('status','!=','D')->with('location_name','user_details')->orderBy('id','desc')->get();
         $response['success'] = true;
         $response['data'] = $data;   
         return Response::json($response);
        
        }catch(\Exception $e){
            $response['error'] = $e->getMessage();
            return Response::json($response);
        }
    }

    public function serviceDetails($id)
    {
        $response = [];
        try{
         
         $data = Service::where('status','!=','D')->with('user_details')->first();
         $response['success'] = true;
         $response['data'] = $data;   
         return Response::json($response);
        
        }catch(\Exception $e){
            $response['error'] = $e->getMessage();
            return Response::json($response);
        }
    }

    public function nearByService()
    {
        $response = [];
        try{
          
           
           
           $services = Service::whereHas('location_name',function($query){
                $distance =  Settings::where('id',1)->first();
                $user_details =  User::where('id',auth()->user()->id)->first();
                $locations_details = LocationModel::where('id',$user_details->location)->first();
                $latitude       =       $locations_details->lat;
                $longitude      =       $locations_details->lon;

                $query->select("*", DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                                * cos(radians(lat)) * cos(radians(lon) - radians(" . $longitude . "))
                                + sin(radians(" .$latitude. ")) * sin(radians(lat))) AS distance"))->havingRaw('distance < '.$distance->to_km.'')
                ->OrderBy('distance');
           });

                     

           $data = $services->get();
           $user_details =  User::where('id',auth()->user()->id)->first();
                $locations_details = LocationModel::where('id',$user_details->location)->first();
                $latitude       =       $locations_details->lat;
                $longitude      =       $locations_details->lon;


           foreach($data as $value)
           {
               $location = LocationModel::where('id',$value->location_id)->first();
                $latitudeFrom = $latitude;
                $longitudeFrom = $longitude;

                $latitudeTo = $location->lat;
                $longitudeTo = $location->lon;

                //Calculate distance from latitude and longitude
                $theta = $longitudeFrom - $longitudeTo;
                $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;

                $distance = round(($miles * 1.609344),2).' km';
                $value['distance'] = $distance; 

           }

           $response['success'] = true;
           $response['data'] = $data;
           return $response;
        }catch(\Exception $e){
            $response['error'] = $e->getMessage();
            return Response::json($response);
        }
    }


}
