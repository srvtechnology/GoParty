<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Admin;
use App\User;
use App\Service;
class HomeController extends Controller
{

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

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
       return redirect()->route('admin.manage.contact');
    }

    public function changeView()
    {
        return view('admin.change_password');
    }

    public function checkOld(Request $request)
    {
         $oldpassword = $request->input('oldpassword');
        if (!\Hash::check($oldpassword,auth()->guard('admin')->user()->password)) {
            $valid = "false";
        }else{
             $valid = "true";
        }
        return $valid;
    }

    public function confrim(Request $request)
    {
        // checking old password matched or not 
        $oldpassword = $request->input('oldpassword');
        if (!\Hash::check($oldpassword,auth()->guard('admin')->user()->password)) {
            return redirect()->back()->with('error','You have entered wrong old password');
        }
        
        $updatepassword = Admin::where('id',auth()->guard('admin')->user()->id)->update([
        'password'=>\Hash::make($request->input('password'))
        ]);
        return redirect()->back()->with('success','Password updated successfully');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function checkemail(Request $request)
    {
        $chk=Admin::where('id','!=',$request->id)->where('email',$request->email)->count();
        if ($chk>0) {
            $valid = "false";
        }else{
            $valid = "true";
        }
        return $valid;
    }

    public function profileUpdate(Request $request)
    {
              $upd=[];
              $upd['name']=$request->name;
              $upd['email']=$request->email;
              if ($request->hasFile('image'))
            {
                 @unlink('storage/app/public/admin_image/' .auth()->guard('admin')->user()->image);
                 $image = $request->image;
                 $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                 $image->move("storage/app/public/admin_image",$filename);
                 $upd['image'] = $filename;
                }
        $update = Admin::where('id',auth()->guard('admin')->user()->id)->update($upd);
        return redirect()->back()->with('success','Profile updated successfully');
    }



}
