@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        @include('_message')
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users List</li>
            </ol>
            <div class="d-flex align-items-center">
                <a href="javascript:void(0)" class="btn btn-info">{{$TotalAdmin}} Admin</a>&nbsp;&nbsp;
                <a href="javascript:void(0)" class="btn btn-secondary">{{$TotalUser}} User</a>&nbsp;&nbsp;
                <a href="javascript:void(0)" class="btn btn-warning">{{$TotalAgent}} Agent</a>&nbsp;&nbsp;
                <a href="javascript:void(0)" class="btn btn-primary">{{$TotalActive}} Active</a>&nbsp;&nbsp;
                <a href="javascript:void(0)" class="btn btn-danger">{{$TotalInactive}} Inactive</a>&nbsp;&nbsp;
                <a href="javascript:void(0)" class="btn btn-success">{{$Total}} Total</a>
            </div>
        </nav>
        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">search Users</h6>
                        <form method="get" action="">
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Id</label>
                                        <input type="text" class="form-control" name="id"
                                            value="{{ Request()->id }}" placeholder="Enter id">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ Request()->name }}" placeholder="Enter name">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username"
                                            value="{{ Request()->username }}" placeholder="Enter username">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Email Id</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ Request()->email }}" placeholder="Enter email id">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ Request()->phone }}" placeholder="Enter phone">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Website</label>
                                        <input type="text" class="form-control" name="website"
                                            value="{{ Request()->website }}" placeholder="Enter website">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        <select class="form-control" name="role">
                                            <option value="">Select Role</option>
                                            <option value="admin" {{ Request()->role == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="user" {{ Request()->role == 'user' ? 'selected' : '' }}>User
                                            </option>
                                            <option value="agent" {{ Request()->role == 'agent' ? 'selected' : '' }}>Agent
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>

                                        <select class="form-control" name="status">
                                            <option value="">Select Status</option>
                                            <option value="active" {{ Request()->status == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="inactive"
                                                {{ Request()->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="form-label">Srart Date</label>
                                    <input type="date" class="form-control" name="start_date"
                                        value="{{ Request()->start_date }}" placeholder="Enter start date">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="form-label">End Date</label>
                                    <input type="date" class="form-control" name="end_date"
                                        value="{{ Request()->end_date }}" placeholder="Enter end date">
                                </div>
                            </div>
                            </div>
                            <button type="submit" class="btn btn-primary ">Search</button>
                            <a href="{{ url('admin/users') }}" class="btn btn-danger">Reset</a>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h4 class="card-title">Users List</h4>
                                <div class="d-flex align-items-center">
                                    <a href="{{ url('admin/users/add') }}" class="btn btn-primary btn-sm">Add User</a>
                                </div>
                            </div>
                            <div class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Photo</th>
                                            <th>Phone</th>
                                            <th>Website</th>
                                            <th>Address</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($getRecord as $value)
                                        <form class="a_form{{ $value->id }}" method="post">
                                            {{ csrf_field() }}
                                            <tr class="table-info text-dark">
                                                <td>{{ $value->id }}</td>
                                                <td style="min-width: 150;">
                                                    <input type="hidden"  name="edit_id"
                                                        value="{{ $value->id }}">
                                                    <input type="text" class="form-control" name="edit_name"
                                                        value="{{ old('name', $value->name) }}" >
                                                        <br>
                                                        <button type="button" class="btn btn-success submitfform"
                                                           id="{{ $value->id }}">Save</button>
                                                </td>
                                                <td>{{ $value->username }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>
                                                    @if (!empty($value->photo))
                                                        <img src="{{ asset('upload/' . $value->photo) }}"
                                                            style="height: 100%; width: 100%;" alt="User Image">
                                                    @endif

                                                </td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->website }}</td>
                                                <td>{{ $value->address }}</td>
                                                <td>
                                                    @if ($value->role == 'admin')
                                                        <span class="badge bg-info">Admin</span>
                                                    @elseif ($value->role == 'user')
                                                        <span class="badge bg-success">User</span>
                                                    @elseif ($value->role == 'agent')
                                                        <span class="badge bg-primary">Agent</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{-- @if ($value->status == 'active')
                                                        <span class="badge bg-primary">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif --}}
                                                    <select class="form-control changeStatus" style="width: 170px;" id={{ $value->id }}>
                                                        <option {{ $value->status == 'active' ? 'selected' : '' }} value="active">
                                                            Active</option>
                                                        <option 
                                                            {{ $value->status == 'inactive' ? 'selected' : '' }} value="inactive">Inactive
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }} </td>
                                                <td>
                                                    <a class="dropdown-item d-flex align-items-center"
                                                        href="{{ url('admin/users/view/' . $value->id) }}"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="feather feather-eye icon-sm me-2">
                                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                            </path>
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                        </svg> <span class="">View </span></a>
                                                    <a class="dropdown-item d-flex align-items-center"
                                                        href="{{ url('admin/users/edit/' . $value->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="feather feather-edit-2 icon-sm me-2">
                                                            <path
                                                                d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                            </path>
                                                        </svg> <span class="">Edit</span></a>
                                                    <a class="dropdown-item d-flex align-items-center"
                                                        href="{{ url('admin/users/delete/' . $value->id) }}" onclick="return confirm('Are you sure you want to delete this record?')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="feather feather-trash icon-sm me-2">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                            </path>
                                                        </svg>
                                                        <span class="">Delete</span></a>
                                            </tr>
                                        </form>

                                        @empty
                                            <tr>
                                                <td colspan="100%">No Record Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div style="padding: 20px; float: right">
                                {{ $getRecord->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@section('script')
    <script type="text/javascript">
        $('table ').delegate('.submitfform', 'click', function() {
           
            var id = $(this).attr('id');
           
            $.ajax({
                url: "{{url('admin/users/update')}}" ,
                method: 'POST',
                data: $('.a_form' + id).serialize(),
                dataType: 'json',
                success: function(response) {
                        alert(response.success);
                    
                }
            });
        });
        $('.changeStatus').change(function() {
            var status_id = $(this).val();
            var order_id = $(this).attr('id');
            $.ajax({
                method: 'GET',
                url: "{{ url('admin/users/changeStatus') }}",
                
                data: {
                    status_id: status_id,
                    order_id: order_id
                },
                dataType: 'json',
                success: function(data) {
                    alert('Status has been changed successfully');
                    window.location.href="";
                }
            });
        });
    </script>
    @endsection