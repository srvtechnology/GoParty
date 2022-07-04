<?php

namespace App\Http\Controllers\Admin\Modules\Banner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use App\Models\Banner;
class BannerController extends Controller
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

    public function update(Request $request)
    {
        $banner = Banner::where('id',1)->first();
    	$upd = [];
        $upd['banner_heading_one'] = $request->banner_heading_one;
        $upd['banner_heading_two'] = $request->banner_heading_two;
        $upd['banner_heading_three'] = $request->banner_heading_three;
        $upd['banner_heading_four'] = $request->banner_heading_four;
       



    	$upd['heading_one'] = $request->heading_one;
    	$upd['heading_two'] = $request->heading_two;
    	$upd['heading_three'] = $request->heading_three;
    	$upd['heading_four'] = $request->heading_four;
    	$upd['heading_five'] = $request->heading_five;
        // $upd['description'] = $request->description;
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
        Banner::where('id',1)->update($upd);
        return redirect()->back()->with('success','Banner Data Updated Succesfully');
    }
}
