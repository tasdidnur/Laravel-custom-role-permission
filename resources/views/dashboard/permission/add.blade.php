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
              <li class="breadcrumb-item active">Permission Resgistration</li>
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
            <h3 class="card-title">Register Permission</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                   <a class="btn btn-block btn-primary" href="{{ url('dashboard/permission') }}">All Permissions</a>
                <div class="input-group-append">
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <form method="post" action="{{ url('dashboard/permission/submit') }}" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                    <div class="form-group {{ $errors->has('role') ? ' has-error' : ''}}">
                        <label for="role">Role<span style="color:red;">*</span></label>
                        <select name="role" class="custom-select rounded-0" id="role">
                          <option value="">Select Your Role</option>
                          @foreach($roles as $role)
                          <option value="{{ $role->id }}">{{ $role->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has ('role'))
                         <span class="invalid-feedback" role="alert">
                           <strong>{{$errors->first('role')}}</strong>
                         </span>
                        @endif
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Permission</th>
                            <th>Add</th>
                            <th>Edit</th>
                            <th>View</th>
                            <th>Delete</th>
                            <th>List</th>
                        </tr>
                        </thead>
                        <tbody>
    
                        <tr>
                            <td>Roles</td>
                            <td><input type="checkbox" name="permission[role][add]" value="1"></td>
                            <td><input type="checkbox" name="permission[role][edit]" value="1"></td>
                            <td><input type="checkbox" name="permission[role][view]" value="1"></td>
                            <td><input type="checkbox" name="permission[role][delete]" value="1"></td>
                            <td><input type="checkbox" name="permission[role][list]" value="1"></td>
    
                        </tr>
                        <tr>
                            <td>Permissions</td>
                            <td><input type="checkbox" name="permission[permission][add]" value="1"></td>
                            <td><input type="checkbox" name="permission[permission][edit]" value="1"></td>
                            <td><input type="checkbox" name="permission[permission][view]" value="1"></td>
                            <td><input type="checkbox" name="permission[permission][delete]" value="1"></td>
                            <td><input type="checkbox" name="permission[permission][list]" value="1"></td>
                        </tr>
                        <tr>
                            <td>Users</td>
                            <td><input type="checkbox" name="permission[user][add]" value="1"></td>
                            <td><input type="checkbox" name="permission[user][edit]" value="1"></td>
                            <td><input type="checkbox" name="permission[user][view]" value="1"></td>
                            <td><input type="checkbox" name="permission[user][delete]" value="1"></td>
                            <td><input type="checkbox" name="permission[user][list]" value="1"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
