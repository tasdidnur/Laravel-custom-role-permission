<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Session;
use Auth;

class RoleController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.permission');
    }

    public function index(){
        $allRole=Role::orderBy('id','DESC')->get();
        $i=1;
        return view('dashboard.role.all',compact('allRole','i'));
    }
  
    public function add(){
        return view('dashboard.role.add');
    }
  
    public function edit($slug){
        $data=role::where('slug',$slug)->firstOrFail();
        return view('dashboard.role.edit',compact('data'));
    }
  
    public function insert(Request $request){
        $this->validate($request,[
        'name' => 'required|max:30|unique:roles,name',
    ],[
        'name.required'=>'Please Enter Role Name!',
    ]);
        $slug=Str::slug($request['name'],'-');
        $insert=Role::insertGetId([
        'name'=>$request['name'],
        'slug'=>$slug,
        'created_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($insert){
        Session::flash('success','Successfully added role information!');
        return redirect('dashboard/role');
        }else{
        Session::flash('error','OOPS Please try again !');
        return redirect('dashboard/role/add');
        }
    }
  
    public function update(Request $request){
        $id=$request['id'];
        $this->validate($request,[
        'name' => 'required|max:30|unique:roles,name,'.$id.'id',    
        ],[
        'name.required'=>'Please Enter Role Name!',
        ]);
        $slug=Str::slug($request['name'],'-');
        $update=Role::where('id',$id)->update([
        'name'=>$request['name'],
        'slug'=>$slug,
        'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($update){
        Session::flash('success','Successfully updated role information!');
        return redirect('dashboard/role');
        }else{
        Session::flash('error','OOPS Please try again!');
        return redirect()->back();
        }
    }
  
    public function delete(){
        $id=$_POST['modal_id'];
        $delete=Role::where('id',$id)->delete();
        if($delete){
        Session::flash('success','Permanently deleted role information!');
        return redirect()->back();
        }else{
        Session::flash('error','OOPS Please try again!');
        return redirect()->back();
        }
    }
  
}
