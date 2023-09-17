@extends('admin.admin_dashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Manager Room </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Room Number</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row" style="justify-content: center">
                
                <div class="col-lg-8 " >
                    <div class="card">
{{-- Start Form xử lí update Room Number --}}
                        <form action="{{ route('update.roomno', $editRoomNo->id) }}" method="post" >
                            @csrf
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Room Number</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="room_no" class="form-control" value="{{ $editRoomNo->room_no }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Status</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                            <select name="status" id="input7" class="form-select">
                                            <option selected="">Selected Status...</option>
                                            <option value="Active" {{$editRoomNo->status == 'Active'?'selected':''}}>Active</option>
                                            <option value="Inactive" {{$editRoomNo->status == 'Inactive'?'selected':''}}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Update" />
                                    </div>
                                </div>
                            </div>
                        </form>
{{-- End Form xử lí update Room Number --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection