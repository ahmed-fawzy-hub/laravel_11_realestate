@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">QRCode</a></li>
            <li class="breadcrumb-item active" aria-current="page">QRCode List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="card-title">QRCode List</h4>
                        <div class="d-flex align-items-center">
                            <a href="{{ url('admin/qode/add') }}" class="btn btn-primary btn-sm">Add QRCode</a>
                        </div>
                    </div>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Product Code</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getRecord as $value)
                                <tr class="table-info text-dark">
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->price }}</td>
                                    <td>{!! DNS2D::getBarcodeHTML($value->product_code, 'QRCODE') !!} Product:{{ $value->product_code }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }} </td>
                                    <td>
                                        
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ url('admin/qrcode/edit/' . $value->id) }}">
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
                                        href="{{ url('admin/qrcode/delete/' . $value->id) }}" onclick="return confirm('Are you sure you want to delete this record?')">
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
                                    </td>
                                    
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <div style="padding: 20px; float: right;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection