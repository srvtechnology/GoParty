<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coupon;
use Validator;
use Response;


class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $redirectTo = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }
    
    public function index()
    {
        $data = [];
    	$data['data'] = Coupon::orderBy('id','desc');
    	if (@$request->keyword) {
    		$data['data'] = $data['data']->where(function($query){
    			$query->where('coupon_title','like','%'.request('keyword').'%')
    			      ->orWhere('coupon_desc','like','%'.request('keyword').'%')
    			      ->orWhere('coupon_price','like','%'.request('keyword').'%')
    			      ->orWhere('exp_date','like','%'.request('keyword').'%');
    		});
    	}
    	$data['data'] = $data['data']->paginate(10);
        return view('admin.coupons.manage',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupons.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $coupon = new Coupon;
            $coupon->coupon_title = $request->coupon_title;
            $coupon->coupon_desc = $request->coupon_desc;
            $coupon->coupon_price = $request->coupon_price;
            $coupon->save();
           return redirect()->back()->with('success','Coupon Added Successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error','Some Thing Went Wrong.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $upd=[];
              $upd['coupon_title']=$request->coupon_title;
              $upd['coupon_desc']=$request->coupon_desc;
              $upd['coupon_price']=$request->coupon_price;
              $upd['exp_date']=$request->exp_date;
           
        $update = Coupon::where('id',$id)->update($upd);
        return redirect()->back()->with('success','Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
    }
}
