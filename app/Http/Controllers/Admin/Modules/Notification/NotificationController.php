<?php

namespace App\Http\Controllers\Admin\Modules\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification;
class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['data'] = Notification::where('status','!=','D')->orderBy('id','desc');
        if (@$request->keyword) {
            $data['data'] = $data['data']->where(function($query){
                $query->where('title','LIKE','%'.request('keyword').'%')
                      ->orWhere('description','LIKE','%'.request('keyword').'%');
            });
        }
        $data['data'] = $data['data']->paginate(20);
        return view('admin.notification.index',$data);
    }

    public function addView()
    {
        return view('admin.notification.add');
    }

    public function add(Request $request)
    {
        $ins = [];
        $ins['title'] = $request->title;
        $ins['description'] = $request->description;
        $ins['date'] = $request->date;
        Notification::create($ins);
        return redirect()->back()->with('success','Notification Added Successfully');
    }

    public function edit($id)
    {
        $data = [];
        $data['data'] = Notification::where('id',$id)->first();
        return view('admin.notification.edit',$data);
    }

    public function update(Request $request)
    {
        $ins = [];
        $ins['title'] = $request->title;
        $ins['description'] = $request->description;
        $ins['date'] = $request->date;
        Notification::where('id',$request->id)->update($ins);
        return redirect()->back()->with('success','Notification Updated Successfully');
    }

    public function delete($id)
    {
        Notification::where('id',$id)->update(['status'=>'D']);
        return redirect()->back()->with('success','Notification Deleted Successfully');
    }
}
