<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\RattingModel;
use Validator;
use Response;

class ApiReviewRattingController extends Controller
{
   
   
    public function reviewSend(Request $request)
    {
        
        try {

            $validator = Validator::make($request->all(), [
               'from_id' => 'required',
            'to_id' => 'required',
            'comment' => 'required',
            'ratting' => 'required',             
            ]);

            if ($validator->fails()) {
              //  $response['error'] = ERRORS['-32704'];
                $response['error']['validation'] = $validator->errors();
                return Response::json($response);
            }

         
           
           //insert in review table
        	$ins=new RattingModel;
        	$ins->from_id=$request->from_id;
        	$ins->to_id=$request->to_id;
        	$ins->comment=$request->comment;
        	$ins->ratting=$request->ratting;
        	$ins->save();

	        //update in user table
	        $allServiceProviderRating= RattingModel::where('to_id',$request->to_id)->get();
	        $upd=[];
	        $upd ['tot_review']=$allServiceProviderRating->count();
	        $upd ['avg_review']= $allServiceProviderRating->sum('ratting')/$allServiceProviderRating->count();
	        User::where('id', $request->to_id)->update($upd);
	        $response['result'] = "Review done";
	        return Response::json($response);
	    }
	    catch (\Throwable $th) {
            $response['error']['message'] = $th->getMessage();
            return Response::json($response);
        } 
    }


}
