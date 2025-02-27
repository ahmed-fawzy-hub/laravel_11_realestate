
@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Schedule</a></li>
            <li class="breadcrumb-item active" aria-current="page">Schedule List</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="card-title">Schedule List</h4>
                        <div class="d-flex align-items-center">
                            
                        </div>
                    </div>
                    <div class="table-responsive pt-3">
                        <form method="post" action="{{url('admin/schedule')}}" >
                            {{ csrf_field() }}
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    
                                    <th>week</th>
                                    <th>open/close
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($week as $row)
                                @php
                                   $getuserweek = App\Models\UserTimeModel::getDetail($row->id);
                                   $open_close = !empty($getuserweek->status) ? $getuserweek->status : '';
                                   $start_time = !empty($getuserweek->start_time) ? $getuserweek->start_time : '';
                                   $end_time = !empty($getuserweek->end_time) ? $getuserweek->end_time : '';
                                @endphp
                                <tr class="table-info text-dark">
                                    <td>{{ !empty($row->name) ? $row->name : ''}}</td>
                                    <td>
                                        <input type="hidden" value="{{$row->id}}"  name="week[{{$row->id}}][week_id]"> 
                                        <label class="switch">
                                        <input type="checkbox" class="change-availabity" name="week[{{$row->id}}][status]" value="1" id="{{$row->id}}" {{!empty($open_close) ? 'checked' : ''}}></label></td>
                                        <td>
                                            <select class="form-control required-{{ $row->id }} show-availabilty-{{ $row->id }}" name="week[{{$row->id}}][start_time]" style="{{!empty($open_close) ? '' : 'display:none'}}" >
                                                <option value="">Select Start Time</option>
                                                @foreach ($week_time_row as $time_row1)
                                                    <option {{trim($start_time)==trim($time_row1) ? 'selected' : ''}} value="{{$time_row1->name}}">{{$time_row1->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control required-{{ $row->id }} show-availabilty-{{ $row->id }}"  name="week[{{$row->id}}][end_time]" style="{{!empty($open_close) ? '' : 'display:none'}}" >
                                                <option value="">Select End Time</option>
                                                
                                                @foreach ($week_time_row as $time_now)
                                                    <option {{trim($end_time)==trim($time_now->name) ? 'selected' : ''}} value="{{$time_now->name}}">{{$time_now->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                </tr>
                                @endforeach
                                




                            </tbody>
                        </table>
                        <br>
                        <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                    <div style="padding: 20px; float: right;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript">
       
            $('.change-availabity').click(function(){
                var id = $(this).attr('id');
                if(this.checked){
                    $('.show-availabilty-'+id).show();
                    $('.required-'+id).prop('required',true);
                }else{
                    $('.show-availabilty-'+id).hide();
                    $('.required-'+id).prop('required',false);
                }
            });
        </script>
@endsection