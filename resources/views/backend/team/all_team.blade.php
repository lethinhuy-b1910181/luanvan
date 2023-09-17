@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Room Type List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group" style="margin-right: 30px">
                <a href="{{ route('add.team') }}"  class="card-title btn btn-primary float-right" ><i class="lni lni-plus">Add New</i></a>
               
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>FaceBook</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($team as $key=> $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><img src="{{ asset($item->image) }}" alt="" style="width: 70px; height:70px;"></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->position }}</td>
                                <td>{{ $item->facebook }}</td>
                                <td>
                                    <a href="{{ route('edit.team', $item->id) }}" class="btn btn-warning px-3 radius-30">Edit</a>
                                    <a href="{{ route('delete.team', $item->id) }}" id="delete" class="btn btn-danger px-3 radius-30">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
    
    <hr/>
    
</div>

@endsection