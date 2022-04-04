@extends('layouts.admin')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">{{ $data->name }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<div class="container-fluid">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      @if(Session::has('success'))
      <div class="alert alert-success" role="alert">
        {{Session::get('success')}}
      </div>
      @endif
      @if(Session::has('error'))
      <div class="alert alert-danger" role="alert">
        {{Session::get('error')}}
      </div>
      @endif
    </div>
    <div class="col-2"></div>
  </div>
    <div class="row">
      <div class="col-lg-2"></div>
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Your Profile</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                   
                <div class="input-group-append">
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <form method="post" action="{{ url('dashboard/profile/update') }}" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="form-group {{ $errors->has('name') ? ' has-error' : ''}}">
                    <label for="name">Name<span style="color:red;">*</span></label>
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <input type="name" name="name" class="form-control" id="name" value="{{ $data->name }}">
                    @if ($errors->has ('name'))
                     <span class="invalid-feedback" role="alert">
                       <strong>{{$errors->first('name')}}</strong>
                     </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="name" name="phone" class="form-control" id="phone" value="{{ $data->phone }}">
                  </div>
                  <div class="form-group {{ $errors->has('email') ? ' has-error' : ''}}">
                    <label for="email">Email<span style="color:red;">*</span></label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ $data->email }}">
                    @if ($errors->has ('email'))
                     <span class="invalid-feedback" role="alert">
                       <strong>{{$errors->first('email')}}</strong>
                     </span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('role') ? ' has-error' : ''}}">
                    <label for="role">Role<span style="color:red;">*</span></label>
                    <select name="role" class="custom-select rounded-0" id="role" disabled>
                      <option value="">Select Your Role</option>
                      @foreach($roles as $role)
                      <option value="{{ $role->id }}" @if($data->role==$role->id) selected @else '' @endif>{{ $role->name }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has ('role'))
                     <span class="invalid-feedback" role="alert">
                       <strong>{{$errors->first('role')}}</strong>
                     </span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('password') ? ' has-error' : ''}}">
                    <label for="password">Password <small style="font-size: 13px;">(Enter password if you want change.)</small></label>
                    <input type="password" name="password" class="form-control" id="password">
                    @if ($errors->has ('password'))
                     <span class="invalid-feedback" role="alert">
                       <strong>{{$errors->first('password')}}</strong>
                     </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose Image</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                        @if($data->image!='')
                        <img width="100" height="100" src='{{ asset('uploads/users/'.$data->image) }}'>
                        @else
                        <img width="100" height="100" src='{{ asset('uploads/users/ava.png') }}'>
                        @endif
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-lg-2"></div>
    </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
