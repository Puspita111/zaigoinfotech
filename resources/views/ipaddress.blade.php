@extends('layout.app')
@section('body')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">White List IP Address</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">White List IP Address</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                @if(session()->has('ip_success'))
                                                            <div class="alert alert-success mb-xl-0" role="alert">
                                               <strong> {{ session()->get('ip_success') }}</strong>
                                            </div>
                                    @endif
                                    <form action="{{route('ip_store')}}" method="post">
                                        @csrf
                                    <div class="col-xxl-12 col-md-12">
                                        <div>
                                            <label for="basiInput" class="form-label">IP Address</label>
                                            <input type="text" class="form-control" id="basiInput" name="ip_address" value="{{old('ip_address')}}" placeholder="Please enter IP Address">
                                        </div>
                                        @error('ip_address')
                                        <span class="validation">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <button type="submit" class="btn btn-primary submit-btn">Add IP Address</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-hover table-striped align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">User Name</th>
                                                <th scope="col">IP Address</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($result as $key=>$ipaddress)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <td>{{optional ($ipaddress->ipaddress)->name}}</td>
                                                <td>{{$ipaddress->ip_address}}</td>
                                                <td>{{$ipaddress->updated_at->diffForHumans()}}</td>
                                                <td><span class="badge bg-success">Active</span></td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input ipactive " type="checkbox" role="switch" id="{{$ipaddress->id}}" @if ($ipaddress->status==1) checked @endif>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- container-fluid -->
    </div>

    <script>

$(document).ready(function(){
    
    $('.ipactive').on('click',function(){
  
    if(this.checked){
        var status = 1;
    }
    else{
        var status = 0;
    }
    $.ajax({
        url:"{{route('updatestatus')}}",
        method:"POST",
        data:{
            id:this.id,
            status:status,
            _token:"{{csrf_token()}}"
        },
        success:function(result){



        }

    });
    });

});


</script>

    @endsection

    




