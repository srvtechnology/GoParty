<?php

namespace App\Http\Controllers\Admin\Modules\Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Image;
class ContactController extends Controller
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


    public function index()
    {
    	$data = [];
    	$data['data'] = Contact::orderBy('id','desc')->paginate(10);
    	return view('admin.contact.manage',$data);
    }

    public function view($id)
    {
    	$data = [];
    	$data['data'] = Contact::where('id',$id)->first();
    	return view('admin.contact.view',$data);
    }

    public function delete($id)
    {
        Contact::where('id',$id)->delete();
        return redirect()->back()->with('success','Data Deleted Successfully');
    }

  
}
