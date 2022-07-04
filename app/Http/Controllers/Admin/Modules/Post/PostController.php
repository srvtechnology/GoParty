<?php

namespace App\Http\Controllers\Admin\Modules\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
class PostController extends Controller
{
    public function index(Request $request)
    {
        $data =[];
        $data['data'] = Post::where('status','!=','D')->orderBy('id','desc');
        if (@$request->keyword) {
            $data['data'] =  $data['data']->where(function($query){
                $query->where('title','LIKE','%'.request('keyword').'%')
                       ->orWhere('description','LIKE','%'.request('keyword').'%')
                        ->orWhereHas('user_details',function($hey){
                            $hey->where('first_name','LIKE','%'.request('keyword').'%');
                        });
            });
           

        }

        if (@$request->status) {
            $data['data'] =  $data['data']->where('status',$request->status);
        }
        if (@$request->ad) {
            $data['data'] =  $data['data']->where('ad_enable',$request->ad);
        }
         $data['data'] =  $data['data']->paginate(20);
        return view('admin.post.index',$data);
    }

    public function approve($id)
    {
        Post::where('id',$id)->update(['status'=>'A']);
        return redirect()->back()->with('success','Post Approved Successfully');
    }

    public function reject($id)
    {
        Post::where('id',$id)->update(['status'=>'R']);
        return redirect()->back()->with('success','Post Rejected Successfully');
    }

    public function status($id)
    {
        $check = Post::where('id',$id)->first();
        if (@$check->status=="A") {
            Post::where('id',$id)->update(['status'=>'I']);
            return redirect()->back()->with('success','Post Deactivated Successfully');
        }else{
            Post::where('id',$id)->update(['status'=>'A']);
            return redirect()->back()->with('success','Post Activated Successfully');
        }
    }

    public function view($id)
    {
        $data = [];
        $data['data'] = Post::where('id',$id)->first();
        return view('admin.post.view',$data);
    }

    public function adStatus($id)
    {
        $check = Post::where('id',$id)->first();
        if (@$check->ad_enable=="D") {
            Post::where('id',$id)->update(['ad_enable'=>'E']);
            return redirect()->back()->with('success','Post Enabled As Advertisement Successfully');
        }else{
            Post::where('id',$id)->update(['ad_enable'=>'D']);
            return redirect()->back()->with('success','Post  Disabled As Advertisement Activated Successfully');
        }
    }
}
