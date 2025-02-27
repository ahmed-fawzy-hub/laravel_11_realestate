@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/users')}}">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add user</li>
            </ol>
        </nav>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Add User</h6>

                    <form class="forms-sample" method="post" action="{{url('admin/users/add')}}" >
                        {{csrf_field()}}
                        <div class="row mb-3">
                            <label  class="col-sm-3 col-form-label">Name <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-sm-3 col-form-label">Username <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-sm-3 col-form-label">Email <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" autocomplete="off"
                                    placeholder="Email" required value="{{old('email')}}" onblur="duplicateEmail(this)">
                                    <span style="color: red;" class="duplicate_message">{{$errors->first('email')}}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="phone"
                                    placeholder="Phone number">
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
                                    <option selected>Select Role </option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                    <option value="agent">Agent</option>
                                </select>
                            </div>
                        </div>
                            <div class="row mb-3">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="status">
                                    <option selected>Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
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
@section('script')
    <script type="text/javascript">
       
            function duplicateEmail(element){
                var email = $(element).val();
                $.ajax({
                    url: "{{url('checkemail')}}",
                    type: 'post',
                    data: {email: email, _token: '{{csrf_token()}}'},
                    dataType: 'json',
                    success: function(res){
                        if(res.exists){
                            $(".duplicate_message").html("Email already exists");
                        }
                        else{
                            $(".duplicate_message").html("");
                    }
                    error: function(error){
                        console.log(error);
                    }
                });
            }
        </script>
@endsection
