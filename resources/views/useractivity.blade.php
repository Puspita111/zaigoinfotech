@extends('layout.app')
@section('body')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">User Activity</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">User Activity</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">

                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                              
                                <th data-ordering="false">#</th>
                                <th data-ordering="false">User name</th>
                                <th data-ordering="false">Date</th>
                                <th data-ordering="false">Type</th>
                                <th data-ordering="false">IP Address</th>
                                <th>Details</th>
                             
                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user_log as $key=>$log)
                            <tr>
                          
                                <td>{{$key+1}}</td>
                                <td>{{$log->name}}</td>
                                <td>{{date("F jS, Y", strtotime($log->log_date))}}</td>
                                <td>{{$log->log_type}}</td>
                                <td>{{json_decode($log->data)->ip}}</td>
                                <td>{{json_decode($log->data)->user_agent}}</td>
                       
                         
</tr>
@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection