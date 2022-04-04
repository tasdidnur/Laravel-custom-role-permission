<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class UserController extends Controller{

  public function __construct(){
      $this->middleware('auth');
      $this->middleware('user.permission');
    }

    public function index(){
      $allUser=User::orderBy('id','DESC')->get();
      $i=1;
      return view('dashboard.user.all',compact('allUser','i'));
    }

    public function add(){
      $roles=Role::get();
      return view('dashboard.user.add',compact('roles'));
    }

      public function edit($id){
        $data=User::where('id',$id)->firstOrFail();
        $roles=Role::get();
        return view('dashboard.user.edit',compact('data','roles'));
      }

      public function view($id){
        $data=User::where('id',$id)->firstOrFail();
        return view('dashboard.user.view',compact('data'));
      }

      public function insert(Request $request){
        $this->validate($request,[
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'role' => ['required'],
      ],[
        'name.required'=>'Please Enter Name!',
        'email.required'=>'Please Enter Email!',
        'password.required'=>'Please Enter Password!',
        'role.required'=>'Please Select Your Role!'
      ]);
        $insert=User::insertGetId([
          'name'=>$request['name'],
          'phone'=>$request['phone'],
          'email'=>$request['email'],
          'role'=>$request['role'],
          'password'=>Hash::make($request['password']),
          'created_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($request->hasFile('image')){
          $image=$request->file('image');
          $imageName='user'.$insert.time().'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(400,400)->save('uploads/users/'.$imageName);

          User::where('id',$insert)->update([
            'image'=>$imageName,
          ]);
        }

        if($insert){
          Session::flash('success','Successfully added user information!');
          return redirect('dashboard/users');
        }else{
          Session::flash('error','OOPS Please try again !');
          return redirect('dashboard/user/add');
        }
      }

      public function update(Request $request){
        $id=$request['id'];
        $this->validate($request,[
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id.',id'],
        'password' => ['sometimes','nullable','min:8'],
        'role' => ['required'],
      ],[
        'name.required'=>'Please Enter Name!',
        'email.required'=>'Please Enter Email!',
        'role.required'=>'Please Select Your Role!'
      ]);
        $update=User::where('id',$id)->update([
          'name'=>$request['name'],
          'phone'=>$request['phone'],
          'email'=>$request['email'],
          'role'=>$request['role'],
          'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($request['password']!=''){
          User::where('id',$id)->update([
            'password'=>Hash::make($request['password']),
          ]);
        }
        
        if($request->hasFile('image')){
          $image=$request->file('image');
          $imageName='user'.$id.time().'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(400,400)->save('uploads/users/'.$imageName);

          User::where('id',$id)->update([
            'image'=>$imageName,
          ]);
        }

        if($update){
          Session::flash('success','Successfully updated user information!');
          return redirect('dashboard/user/view/'.$id);
        }else{
          Session::flash('error','OOPS Please try again!');
          return redirect('dashboard/user/update/'.$id);
        }
      }

      public function delete(){
        $id=$_POST['modal_id'];
        // $image=User::where('id',$id)->firstOrFail();
        $delete=User::where('id',$id)->delete();
        if($delete){
          Session::flash('success','Permanently deleted user information!');
          return redirect('dashboard/users');
        }else{
          Session::flash('error','OOPS Please try again!');
          return redirect('dashboard/users');
        }
      }
    
}
