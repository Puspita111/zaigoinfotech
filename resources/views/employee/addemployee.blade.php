@extends('layout.app')
@section('body')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Create New Employee</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Employee</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-2">
                        <h5 class="card-title mb-0">Employee Bulk Upload</h5>
                        
                    </div>
                    <div class="col-6">
                        <form action="{{route('bulkaction')}}" method="post" enctype="multipart/form-data">
                            @csrf
                    <input class="form-control form-control-sm" name="bulkupload" type="file">
                    <small>Add employee through excel sheet. Allowable format .csv</small>
</div>

@error('bulkupload')
                            <div class="validation" role="alert">
                                               <strong> {{$message}}</strong>
                                            </div>
                            @enderror
<div class="col-4 ">
                    <button type="submit" class="btn btn-primary flot_left">Upload</button>
                    </div>
                    </form>
                   
                </div>
                <hr>
                <div class="col-6">
    Please download the sample csv file here.
    <a href="{{url('/sample_download')}}"><button type="button" class="btn btn-success btn-label"><i class=" bx bx-cloud-download label-icon align-middle fs-16 me-2"></i> Download Sample</button></a>
</div>
            </div>

    </div>
    <div class="card">
        <div class="card-header">
            <h4>
                Add Employee
            </h4>
        </div>
        <div class="card-body">
        <form action="{{route('addemployee')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control"  name="first_name" id="first_name" value="{{old('first_name')}}">
                            </div>
                            @error('first_name')
                            <div class="validation" role="alert">
                                               <strong> {{$message}}</strong>
                                            </div>
                            @enderror
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control"  name="last_name" value="{{old('last_name')}}" placeholder="Enter lastname">
                            </div>
                            @error('last_name')
                            <div class="validation" role="alert">
                                               <strong> {{$message}}</strong>
                                            </div>
                            @enderror
                        </div>
                        <div class="col-xxl-6">
                        
                            <div>
                                <label for="firstName" class="form-label">Employee Id</label>
                                <input type="text" class="form-control" name="employee_id" value="{{old('employee_id')}}" placeholder="Enter Employee id">
                            </div>
                            @error('employee_id')
                            <div class="validation" role="alert">
                                               <strong> {{$message}}</strong>
                                            </div>
                            @enderror
                       
                        </div>
                        <div class="col-xxl-6">
                        
                        <div>
                            <label for="firstName" class="form-label">Salary</label>
                            <input type="text" class="form-control" name="salary" value="{{old('salary')}}"placeholder="Enter Salary">
                        </div>
                        @error('salary')
                            <div class="validation" role="alert">
                                               <strong> {{$message}}</strong>
                                            </div>
                            @enderror
                       
                   
                    </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="genderInput" class="form-label">Gender</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender"  value="Male">
                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender"  value="Female">
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender"  value="Others">
                                    <label class="form-check-label" for="inlineRadio3">Others</label>
                                </div>
                            </div>
                        </div>
                        @error('gender')
                            <div class="validation" role="alert">
                                               <strong> {{$message}}</strong>
                                            </div>
                            @enderror<!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="emailInput" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Enter your email">
                            </div>
                        </div>
                        @error('email')
                            <div class="validation" role="alert">
                                               <strong> {{$message}}</strong>
                                            </div>
                            @enderror<!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="passwordInput" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{old('phone')}}" placeholder="Enter your phone">
                            </div>
                        </div>
                        @error('phone')
                            <div class="validation" role="alert">
                                               <strong> {{$message}}</strong>
                                            </div>
                            @enderror
                        <div class="col-xxl-6">
                            <div>
                                <label for="passwordInput" class="form-label">Date of Joining</label>
                                <input type="date" class="form-control" name="doj" value="{{old('doj')}}">
                            </div>
                        </div>
                        @error('doj')
                            <div class="validation" role="alert">
                                               <strong> {{$message}}</strong>
                                            </div>
                            @enderror
                        <div class="col-xxl-6">
                        <label for="passwordInput" class="form-label">image</label>
                        <input class="form-control form-control-sm" name="image" type="file" />
                        </div>
                        @error('image')
                            <div class="validation" role="alert">
                                               <strong> {{$message}}</strong>
                                            </div>
                            @enderror<!--end col-->
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
        </div>
    </div>
</div>



@endsection