<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use Session;
use Auth;

class PermissionController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.permission');
    }

    public function index(){
        $permissions = Permission::all();
        $i=1;
        return view('dashboard.permission.all',compact('permissions','i'));
    }

    public function add(){
        $roles=Role::get();
        return view('dashboard.permission.add',compact('roles'));
    }

    public function edit($id){
        $data=Permission::where('id',$id)->firstOrFail();
        $roles=Role::get();
        return view('dashboard.permission.edit',compact('data','roles'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'role'=>'required|unique:permissions',
            'permission'=>'required'
         ]);
         $insert=Permission::create($request->all());
         if($insert){
            Session::flash('success','Successfully added Permission information!');
            return redirect()->back();
          }else{
            Session::flash('error','OOPS Please try again !');
            return redirect()->back();
          }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $id=$request['id'];
        $request->validate([
            'permission'=>'required',
         ]);
        // $data=request()->except(['_token']);
        $update=Permission::where('id',$id)->update($request->except(['_token'])); 
        if($update){
            Session::flash('success','Successfully updated Permission information!');
            return redirect()->back();
          }else{
            Session::flash('error','OOPS Please try again !');
            return redirect()->back();
          }
    }

    public function delete(){
        $id=$_POST['modal_id'];
         // $image=User::where('id',$id)->firstOrFail();
        $delete=Permission::where('id',$id)->delete();
         if($delete){
           Session::flash('success','Permanently deleted Permission information!');
           return redirect()->back();
         }else{
           Session::flash('error','OOPS Please try again!');
           return redirect()->back();
         }
    }

   
}
