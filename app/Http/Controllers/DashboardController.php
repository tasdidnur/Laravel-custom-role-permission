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

class DashboardController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
    }
  
  public function index(){
    return view('dashboard.index');
  }

  public function profile(){
    $id=Auth::user()->id;
    $data=User::where('id',$id)->firstOrFail();
    $roles=Role::orderBy('id','DESC')->get();
    return view('dashboard.profile.proflie',compact('data','roles'));
  }
  
  public function profileUp(Request $request){
    $id=$request['id'];
    $this->validate($request,[
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id.',id'],
    'password' => ['sometimes','nullable','min:8'],
    ],[
    'name.required'=>'Please Enter Name!',
    'email.required'=>'Please Enter Email!',
    ]);
    $update=User::where('id',$id)->update([
      'name'=>$request['name'],
      'phone'=>$request['phone'],
      'email'=>$request['email'],
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
      Session::flash('success','Successfully updated profile information!');
      return redirect('dashboard/profile');
    }else{
      Session::flash('error','OOPS Please try again!');
      return redirect('dashboard/user/update/'.$id);
    }
  }

  
}
