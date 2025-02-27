@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/users') }}">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update profile</li>
            </ol>
        </nav>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Update profile</h6>

                    <form class="forms-sample" method="post" action="{{ url('admin/my_profile/update') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Name <span style="color: red"></span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" placeholder="Name"
                                    value="{{ $getRecord->name }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Email <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" autocomplete="off"
                                    placeholder="Email" required value="{{ old('email', $getRecord->email) }}">
                                @if (!empty($getRecord->photo))
                                    <img src="{{ asset('upload/' . $getRecord->photo) }}" height="100px" width="100px">
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Password <span style="color: red"></span></label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                (Leave empty if you don't want to change password)
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Profile Image <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="photo" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Update</button>


                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
