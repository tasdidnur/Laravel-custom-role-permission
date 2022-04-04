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
              <li class="breadcrumb-item active">Roles</li>
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
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">All Roles</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                @isset(Auth::user()->roleInfo->permissionInfo['permission']['role']['add'])
                   <a class="btn btn-block btn-primary" href="{{ url('dashboard/role/add') }}">Add Role</a>
                @endisset   
                <div class="input-group-append">
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table id="myTable" class="table table-bordered table-hover text-nowrap">
              <thead>
                <tr>
                  <th>SL.</th>
                  <th>Role Name</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach($allRole as $data)
                <tr>
                  <td>
                    @if($i<'10')
                    0{{ $i++ }}
                    @else
                     {{ $i++ }}
                    @endif
                  </td>
                  <td>{{ $data->name }}</td>
                  <td>{{ optional($data->created_at)->format('d-m-Y || h-i-s A') }}</td>
                  <td>{{ optional($data->updated_at)->format('d-m-Y || h-i-s A') }}</td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">Manage </button>
                      <div class="dropdown-menu" role="menu">
                        @isset(Auth::user()->roleInfo->permissionInfo['permission']['role']['edit'])
                        <a class="dropdown-item" href="{{ url('dashboard/role/edit/'.$data->slug) }}">Edit</a>
                        @endisset
                        @isset(Auth::user()->roleInfo->permissionInfo['permission']['role']['delete'])
                        <a href="#" class="dropdown-item btn btn-danger" id="delete" data-toggle="modal" data-target="#modal-danger" data-id={{ $data->id }}>Delete</a>
                        @endisset
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.content-wrapper -->


  <!-- /.modal -->
  <div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
      <form method="post" action="{{url('dashboard/role/delete')}}">
        @csrf
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Do you want to sure delete?</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body modal_body">
          <p>You won't be able to restore this information.</p>
          <input type="hidden" name="modal_id" id='modal_id' value="1">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-outline-light">CONFIRM</button>
        </div>
      </div>
      </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  @endsection
