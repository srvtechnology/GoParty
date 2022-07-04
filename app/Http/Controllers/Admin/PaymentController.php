<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\PaymentModel;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            $data = [];
            $data['payments']=PaymentModel::orderBy('updated_at','desc')->where('is_delete','N');
    
            if(@$request->from_date && @$request->to_date){
               $from = $request->from_date;
               $to_prev= $request->to_date;
               $to=date('Y-m-d', strtotime($to_prev. ' + 1 days'));
    
                $data['payments']=$data['payments']->whereBetween('updated_at',[$from, $to])->where('is_delete','N')->orderBy('updated_at','desc')->OrwhereBetween('created_at',[$from, $to])->where('is_delete','N')->orderBy('updated_at','desc');
                $data['res']=$request->all();
            }

            if (@$request->status) {
                $data['payments']=$data['payments']->where('status_id',@$request->status);
            }

            if (@$request->keyword) {
                $data['payments']=$data['payments']->where(function($query){
                    $query->where('customerName','LIKE','%'.request('keyword').'%')
                          ->orWhere('customerEmail','LIKE','%'.request('keyword').'%')
                           ->orWhere('customerPhone','LIKE','%'.request('keyword').'%')
                           ->orWhere('transaction_id','LIKE','%'.request('keyword').'%');
                });
            }

            $data['payments']=$data['payments']->paginate(20);
            return view('admin.payment.paid_users_list',$data);
    
    }

   public function delete($id)
   {
        PaymentModel::where('id',$id)->update(['is_delete'=>'Y']);
        return redirect()->back()->with('success','Data Deleted Successfully');
   }
}
