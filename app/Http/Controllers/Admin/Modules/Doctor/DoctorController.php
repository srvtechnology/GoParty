<?php

namespace App\Http\Controllers\Admin\Modules\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\DoctorWhy;
use Image;
use App\Models\Provider;
use App\Models\CommonUse;
class DoctorController extends Controller
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

    public function banner()
    {
    	$data = [];
    	$data['data'] = Banner::where('id',3)->first();
    	return view('admin.doctor.banner',$data);
    }

    public function bannerUpdate(Request $request)
    {
    	$banner = Banner::where('id',3)->first();
    	$upd = [];
    	$upd['heading_one'] = $request->heading_one;
    	$upd['heading_two'] = $request->heading_two;
    	
    	if ($request->image) {
           @unlink('storage/app/public/banner_min/'.$banner->image);
           @unlink('storage/app/public/banner/'.$banner->image);
    	   $image = $request->image;
           $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
           $resize_image = Image::make($image->getRealPath());
           $resize_image->resize(1000, 1000, function($constraint){
                $constraint->aspectRatio();
            })->save("storage/app/public/banner_min" . '/' . $filename);
            //real image
            $image->move("storage/app/public/banner",$filename);	
            $upd['image'] = $filename;
    	}
        Banner::where('id',3)->update($upd);
        return redirect()->back()->with('success','Banner Data Updated Succesfully');
    }

    public function about(Request $request)
    {
    	$data = [];
    	$data['data'] = DoctorWhy::where('id',1)->first();
    	return view('admin.doctor.about',$data);
    }


    public function aboutUpdate(Request $request)
    {
    	$banner = DoctorWhy::where('id',1)->first();
    	$upd = [];
    	$upd['heading_one'] = $request->heading_one;
    	$upd['heading_two'] = $request->heading_two;
    	$upd['heading_three'] = $request->heading_three;
    	$upd['heading_four'] = $request->heading_four;
    	$upd['heading_five'] = $request->heading_five;
    	$upd['heading_six'] = $request->heading_six;
    	$upd['description'] = $request->description;
    	
    	if ($request->image) {
           @unlink('storage/app/public/about_min/'.$banner->image);
           @unlink('storage/app/public/about/'.$banner->image);
    	   $image = $request->image;
           $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
           $resize_image = Image::make($image->getRealPath());
           $resize_image->resize(1000, 1000, function($constraint){
                $constraint->aspectRatio();
            })->save("storage/app/public/about_min" . '/' . $filename);
            //real image
            $image->move("storage/app/public/about",$filename);	
            $upd['image'] = $filename;
    	}
        DoctorWhy::where('id',1)->update($upd);
        return redirect()->back()->with('success','About Data Updated Succesfully');
    }

    public function provider()
    {
    	$data = [];
    	$data['data'] = Provider::orderBy('id','desc')->paginate(10);
    	return view('admin.doctor.provider',$data);
    }

    public function providerUpload(Request $request)
    {
    	if ($request->image) {
           $image = $request->image;
           $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
           $resize_image = Image::make($image->getRealPath());
           $resize_image->resize(1000, 1000, function($constraint){
                $constraint->aspectRatio();
            })->save("storage/app/public/provider_min" . '/' . $filename);
            //real image
            $image->move("storage/app/public/provider",$filename);	
            $ins['image'] = $filename;
            Provider::create($ins);
    	}
    	return redirect()->back()->with('success','Provider Logo Uploaded Successfully');

    }


    public function providerDelete($id)
    {
    	Provider::where('id',$id)->delete();
    	return redirect()->back()->with('success','Provider Logo Deleted Successfully');
    }

    public function commonUse(Request $request)
    {
    	$data = [];
        $data['data'] = CommonUse::where('id',1)->first();
        return view('admin.doctor.common',$data);
    }

    public function commonUseUpdate(Request $request)
    {
        $banner = CommonUse::where('id',1)->first();
        $upd = [];
        $upd['heading'] = $request->heading;
        $upd['description'] = $request->description;
        
        if ($request->image) {
           @unlink('storage/app/public/common_min/'.$banner->image);
           @unlink('storage/app/public/common/'.$banner->image);
           $image = $request->image;
           $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
           $resize_image = Image::make($image->getRealPath());
           $resize_image->resize(1000, 1000, function($constraint){
                $constraint->aspectRatio();
            })->save("storage/app/public/common_min" . '/' . $filename);
            //real image
            $image->move("storage/app/public/common",$filename);    
            $upd['image'] = $filename;
        }
        CommonUse::where('id',1)->update($upd);
        return redirect()->back()->with('success','Data Updated Succesfully');
    }
}
