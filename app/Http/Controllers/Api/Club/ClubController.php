<?php

namespace App\Http\Controllers\Api\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Response;
use App\Models\LocationModel;
class ClubController extends Controller
{
    public function index()
    {
        $response = [];
        try{
        
         $clubs = LocationModel::where('status','!=','D')->orderBy('id','desc')->get();
         $response['success'] = true;
         $response['clubs'] = $clubs;   
         return Response::json($response);
        
        }catch(\Exception $e){
            $response['error'] = $e->getMessage();
            return Response::json($response);
        }
    }
}
