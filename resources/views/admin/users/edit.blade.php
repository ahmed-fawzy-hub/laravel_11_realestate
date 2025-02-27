@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/users')}}">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update User</li>
            </ol>
        </nav>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Update User</h6>

                    <form class="forms-sample" method="post" action="{{url('admin/users/add/'.$getRecord->id)}}" >
                        {{csrf_field()}}
                        <div class="row mb-3">
                            <label  class="col-sm-3 col-form-label">Name <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" value="{{ $getRecord->name }}" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-sm-3 col-form-label">Username <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" placeholder="Username" value="{{ $getRecord->username }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-sm-3 col-form-label">Email <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" autocomplete="off"
                                    placeholder="Email" required value="{{ $getRecord->email }}">
                                    <span style="color: red">{{$errors->first('email')}}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="phone"
                                    placeholder="Phone number" value="{{ $getRecord->phone }}" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-sm-3 col-form-label">Password <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" autocomplete="off" name="password"
                                    placeholder="Password" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-sm-3 col-form-label">Role <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-select" name="role" required>
                                    <option value="">Select Role </option>
                                    <option {{$getRecord->role == 'admin' ? 'selected' : ''}}>Admin</option>
                                    <option {{$getRecord->role == 'user' ? 'selected' : ''}}>User</option>
                                    <option {{$getRecord->role == 'agent' ? 'selected' : ''}}>Agent</option>
                                </select>
                            </div>
                        </div>
                            <div class="row mb-3">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="status">
                                    <option selected>Select Status</option>
                                    <option {{$getRecord->status == 'active' ? 'selected' : ''}}>Active</option>
                                    <option {{$getRecord->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
                                </select>
                            </div>
                            </div>
                            <div class="row mb-3">
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">
                                Remember me
                            </label>
                        </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{url('admin/users')}}" class="btn btn-secondary">Cancel</a>
                        
                    </form>
                
                </div>
            </div>
        </div>
    </div>
@endsection
