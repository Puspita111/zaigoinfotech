@extends('layout.app')
@section('body')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<!--datatable responsive css-->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">



<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Employee</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Employee</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>


        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12">

                     


                        <h5 class="card-title mb-0">Employee List</h5>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10px;">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th data-ordering="false">#</th>
                                <th data-ordering="false">Employee ID</th>
                                <th data-ordering="false">Name</th>
                                <th data-ordering="false">DOJ</th>
                                <th data-ordering="false">Gender</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emp as $key=>$empl)

                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                    </div>
                                </th>
                                <td>{{$key + 1}}</td>
                                <td>{{$empl->employee_id}}</td>
                                <td><span><img src="{{$empl->image}}" alt="" class="avatar-xs rounded-circle"></span> {{$empl->name}}</td>

                              
                                <td>{{$empl->doj}}</td>
                                <td>{{$empl->gender}}</td>
                                <td>{{$empl->email}}</td>
                                <td>{{$empl->phone}}</td>
                                <td>{{$empl->salary}}</td>
                                
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                         
                                            <li class="edit_emp" id="{{$empl->id}}"><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                            <li>
                                                <a class="dropdown-item remove-item-btn" href="{{url('/employee_delete',Crypt::encrypt($empl->id))}}">
                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- modal -->

        <!-- Grids in modals -->




        <div class="modal fade" id="emp_edit" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalgridLabel">Edit Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('update_employee')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="emp_id">
                            <div class="row g-3">
                                <div class="col-xxl-6">
                                    <div>
                                        <label for="firstName" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="empl_name" value="{{old('first_name')}}" placeholder="Enter firstname">
                                    </div>
                                
                                </div>
                                <div class="col-xxl-6">
                                    <div>
                                        <label for="passwordInput" class="form-label">Date of Joining</label>
                                        <input type="date" class="form-control" name="doj" id="empl_doj">
                                    </div>
                                </div>
                                <div class="col-xxl-6">

                                    <div>
                                        <label for="firstName" class="form-label">Employee Id</label>
                                        <input type="text" class="form-control" name="employee_id" id="empl_id" placeholder="Enter Employee id">
                                    </div>

                                </div>
                                <div class="col-xxl-6">

                                    <div>
                                        <label for="firstName" class="form-label">Salary</label>
                                        <input type="text" class="form-control" name="salary" id="empl_salary" placeholder="Enter Salary">
                                    </div>

                                </div><!--end col-->
                                <div class="col-lg-12">
                                    <label for="genderInput" class="form-label">Gender</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" value="Male">
                                            <label class="form-check-label" for="inlineRadio1">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" value="Female">
                                            <label class="form-check-label" for="inlineRadio2">Female</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" value="Others">
                                            <label class="form-check-label" for="inlineRadio3">Others</label>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-xxl-6">
                                    <div>
                                        <label for="emailInput" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="empl_email" placeholder="Enter your email">
                                    </div>
                                </div><!--end col-->
                                <div class="col-xxl-6">
                                    <div>
                                        <label for="passwordInput" class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="phone" id="empl_phone" placeholder="Enter your phone">
                                    </div>
                                </div>
                                
                                
                                <div class="col-xxl-6">
                                    <label for="passwordInput" class="form-label">image</label>
                                    <input class="form-control form-control-sm" name="image" id="empl_img" type="file" />
                                </div><!--end col-->
                                <div class="col-xxl-6">
                                    <div id="img">
                                        
                                    </div>
                                </div>
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
        </div>

        <!-- endmodal -->


    </div>
</div>
@script
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

<script src="assets/js/pages/datatables.init.js"></script>
<script>
    $('.edit_emp').on('click', function() {
        var id = $(this).attr('id');
        // alert(id);
        
        $.ajax({
            url:"{{url('edit_employee')}}",
            data:{
                id:id,
                _token:'{{csrf_token()}}',
            },
            dataType:'json',
            type:'post',
            success:function(result){
                console.log(result.name);
                $('#emp_id').val(result.id);
                $('#emp_edit').modal('show');
                $('#empl_name').val(result.name);
                $('#empl_id').val(result.employee_id);
                $('#empl_salary').val(result.salary);
                $('#empl_email').val(result.email);
                $('#empl_phone').val(result.phone);
                $('#empl_doj').val(result.doj);
                $('#img').html('<img src="'+ result.image +'" alt="employee_image" style="width:60px;">');
                $('input[name="gender"][value="'+ result.gender + '"]').prop('checked', true);
            },
        });
    });
</script>

@if (session()->has('employee_create_error'))
<script type="text/javascript">
    $(document).ready(function() {
        $('#exampleModalgrid').modal('show');
    });
</script>
@endif

@endscript
@endsection