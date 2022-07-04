<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\RattingModel;

class RatingController extends Controller
{
    

     public function review_list(Request $request){
    	$data['allReviews']=RattingModel::orderBy('created_at','desc');
    	//dd($data['allReviews']);
     if(@$request->all()){

        @$keyword=$request->keyword;
         @$from_date = $request->from_date;
         @$to_prev= $request->to_date;
         @$to=date('Y-m-d', strtotime($to_prev. ' + 1 days'));

        if($from_date && $to){
            $data['allReviews']=$data['allReviews']->whereBetween('created_at',[$from_date, $to]);
           
          }

          if($keyword){

              $data['allReviews']->where(function($q) use ($keyword) {
                  $q->whereHas('getFromUserDetails', function( $query ) use ( $keyword ){
                        $query->where('first_name','LIKE', "%".$keyword."%");
                    })->orWhereHas('getFromUserDetails', function( $query ) use ( $keyword ){
                        $query->where('last_name','LIKE',"%".$keyword."%");
                    })->orWhereHas('getToUserDetails', function( $query ) use ( $keyword ){
                        $query->where('first_name','LIKE',"%".$keyword."%");
                    })->orWhereHas('getToUserDetails', function( $query ) use ( $keyword ){
                        $query->where('last_name','LIKE',"%".$keyword."%");
                    });
              });
               }

         if($request->ratting){
            $data['allReviews']=$data['allReviews']->where('ratting','=',$request->ratting);
          }

        $data['res']=$request->all();
      }
    $data['allReviews']=$data['allReviews']->paginate(10);

    	return view('admin.review.reviewlist')->with($data);

    }






    public function review_delete(Request $request,$id){ 	
    	$review_id=$id;
    	$reviewDetails=RattingModel::where('id',$review_id)->first();
    	
    	$ServiceUserId=$reviewDetails->to_id;
    	//---------DELETE THE REVIEW-----------
    	$review_delete=RattingModel::where('id',$review_id)->delete();

    	//----------UPDATE REVIEW OF THAT DRIVER AFTER DELETE-----------

    	$allReview=RattingModel::where('to_id',$ServiceUserId)->count();
    	$avgReview=RattingModel::where('to_id',$ServiceUserId)->avg('ratting');
    	//dd($avgReview);

    	if($allReview>0){

    	$upd=array(
    		'tot_review'=>$allReview,
    		'avg_review'=>$avgReview
        );

        $driverUpd=User::where('id',$ServiceUserId)->update($upd);
        }
        else{
        	$upd=array(
    		'tot_review'=>0,
    		'avg_review'=>0
        );

        $driverUpd=User::where('id',$ServiceUserId)->update($upd);

        }

        return back()->with('success','Review successfully deleted');




    }



     public function one_review_view(Request $request,$id){
      //dd($request->id);
      $review_details['rev']=RattingModel::where('id',$id)->first();
      //dd( $review_details['review_details']);
       return view('admin.review.one_review',$review_details);
    }





}
