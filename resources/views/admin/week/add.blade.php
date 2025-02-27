@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/week')}}">Week</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Week</li>
            </ol>
        </nav>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Add Week</h6>

                    <form class="forms-sample" method="post" action="{{url('admin/week/add')}}" >
                        {{csrf_field()}}
                        <div class="row mb-3">
                            <label  class="col-sm-3 col-form-label">Name <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                            </div>
                        </div>
                        
                        
                        
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{url('admin/week')}}" class="btn btn-secondary">Cancel</a>
                        
                    </form>
                
                </div>
            </div>
        </div>
    </div>
@endsection
