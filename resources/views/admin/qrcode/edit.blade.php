@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/qrcode')}}">QRCode</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit QRCode</li>
            </ol>
        </nav>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Edit QRCode</h6>

                    <form class="forms-sample" method="post" action="{{url('admin/qrcode/edit/'.$getRecord->id)}}" >
                        {{csrf_field()}}
                        <div class="row mb-3">
                            <label  class="col-sm-3 col-form-label">Title <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{$getRecord->title}}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-sm-3 col-form-label">Price <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="price" placeholder="Enter Price" value="{{$getRecord->price}}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-sm-3 col-form-label">Description <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" placeholder="Enter Description" required> {{ $getRecord->description }}</textarea>
                            </div>
                        </div>
                        
                        
                        <button type="submit" class="btn btn-primary me-2">Update</button>
                        <a href="{{url('admin/qrcode')}}" class="btn btn-secondary">Cancel</a>
                        
                    </form>
                
                </div>
            </div>
        </div>
    </div>
@endsection
