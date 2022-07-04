<?php

namespace App\Http\Controllers\Admin\Modules\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Service;
class UserController extends Controller
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

    public function index(Request $request)
    {
    	$data = [];
        $service = Service::where('status','A')->pluck('user_id')->toArray();
        $uniq_users = array_unique($service);

    	$data['data'] = User::where('status','!=','D')->orderBy('id','desc');
    	if (@$request->keyword) {
    		$data['data'] = $data['data']->where(function($query){
    			$query->where('first_name','like','%'.request('keyword').'%')
    			      ->orWhere('last_name','like','%'.request('keyword').'%')
    			      ->orWhere('email','like','%'.request('keyword').'%')
    			      ->orWhere('ph_number','like','%'.request('keyword').'%');
    		});
    	}

        if (@$request->user_type=="2") {
            $data['data'] = $data['data']->whereIn('id',$uniq_users);
        }

        if (@$request->user_type=="1") {
            $data['data'] = $data['data']->whereNotIn('id',$uniq_users);;
        }
        
        $data['uniq_users']  = $uniq_users;
    	$data['data'] = $data['data']->paginate(10);
    	return view('admin.users.manage',$data);
    }

    public function status($id)
    {
    	$check = User::where('id',$id)->first();
    	if (@$check->status=="A") {
    		User::where('id',$id)->update(['status'=>'I']);
    		return redirect()->back()->with('success','User Deactivated Successfully');
    	}else{
    		User::where('id',$id)->update(['status'=>'A']);
    		return redirect()->back()->with('success','User Activated Successfully');
    	}
    }


    public function delete($id)
    {
    	User::where('id',$id)->update(['status'=>'D']);
    	return redirect()->back()->with('success','User Deleted Successfully');
    }

    public function viewService($id)
    {
        $data = [];
        $data['data'] = Service::where('user_id',$id)->where('status','!=','D')->paginate(10);
        return view('admin.users.service',$data);
    }
}
