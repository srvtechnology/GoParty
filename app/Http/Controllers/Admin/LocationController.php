<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LocationModel;

class LocationController extends Controller
{
    




     public function location_list(){
        $data['location']=LocationModel::where('status','!=','D')->orderBy('id')->paginate(10);
        return view('admin.location.location_list')->with($data);
    }



    public function location_add_page(){
       // $data['dummy']=DummyText::first();
        return view('admin.location.location_add');
    }


    public function location_ins(Request $request){
       // dd($request->all());
            $request->validate([
            'location_name' => 'required',
        ]);

        $ins_location=new LocationModel;
        $ins_location->location_name=$request->location_name;
        $ins_location->lat=$request->lat;
        $ins_location->lon=$request->lon;
        $ins_location->status='A';
        $ins_location->save();

        return back()->with('success','Location added successfully');
    }





    public function location_active($id){
        // dd($id);
        $obj=LocationModel::where('id','=',$id)->update(['status'=>'A']);
        return back()->with("success",'location successfully activated');
    }


    public function location_inactive($id){
        // dd($id);
        $obj=LocationModel::where('id','=',$id)->update(['status'=>'I']);
        return back()->with("success",'location successfully deactivated');
    }


      public function location_delete($id){
        // dd($id);
        $obj=LocationModel::where('id','=',$id)->update(['status'=>'D']);
        return back()->with("success",'location successfully deleted');
    }





    public function location_edit_form($id){
        $data['location']=LocationModel::where('id',$id)->first();
        return view('admin.location.location_edit')->with($data);
    }




    public function update_location(Request $request){
        //dd($request->all());
            $request->validate([
            'location_name' => 'required',
          
        ]);

            $upd['location_name']=$request->location_name;
            $upd['lat']=$request->lat;
            $upd['lon']=$request->lon;
           
            $u=LocationModel::where('id',$request->id)->update($upd);
             return back()->with("success",'Location successfully updated');
    }
















}
