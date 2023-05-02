<?php

namespace App\Http\Controllers;

use App\Imports\EmployeeImport;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    public function index(){
        $emp = Employee::all();
        
        return view('employee.index', compact('emp'));
    }
    public function store(Request $request){

        $validate=Validator::make($request->all(),[
            'first_name'=>'required',
            'last_name'=>'required',
            'employee_id'=>'required',
            'salary'=>'required',
            'gender'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'doj'=>'required',
            'image'=>'required|image|mimes:jpg,png,jpeg,gif,svg',
            
         ],
         $message=[
            'first_name.required'=>'Please Enter First Name',
            'last_name.required'=>'Please Enter Last Name',
            'employee_id'=> 'Please Enter Employee ID',
            'salary'=> 'Please Enter salary',
            'gender'=> 'Please Enter gender',
            'email'=> 'Please Enter email',
            'phone'=> 'Please Enter phone',
            'doj'=> 'Please Enter doj',
            'image'=> 'Please Enter image',
            
         ]
      );
      if($validate->fails()){

        Session::flash('employee_create_error',true);
        return redirect()->back()->withErrors($validate);
        
      }
//image process
        $name = $request->file('image')->getClientOriginalName();
        $request->image->move(('employee_image/'), $name);
 
       // $path = $request->file('image')->store('public/images');


      $insert = new Employee;
      $insert->employee_id = $request->employee_id;
      $insert->name = $request->first_name ." ".$request->last_name;
      $insert->salary = $request->salary;
      $insert->image = 'employee_image/'.$name;
      $insert->gender = $request->gender;
      $insert->email = $request->email;
      $insert->phone  = $request->phone;
      $insert->doj = $request->doj;
      $insert->created_by = Auth::id();
      $insert->save();
return redirect ('/employee');

    }
    public function create(){
        return view('employee.addemployee');
    }
    public function bulkaction(Request $request){

        $validate = Validator::make($request->all(),[
            'bulkupload'=>'required|mimes:csv,txt'

        ],
        $message = [
            'bulkupload.required' => 'Please upload a excel sheet',
            'bulkupload.mimes'=> 'The uploaded format is not supported'
        ]
    );

    if($validate->fails()){
        Session::flash('bulkupload_error',true);
        return redirect()->back()->withErrors($validate);
    }
    else{

        Excel::import(new EmployeeImport($request->created_by),$request->file('bulkupload')->store('bulkupload'));
      return redirect ('/employee');
    }
    


    }
    public function edit(Request $request){
       
        $empl = Employee::find($request->id)->first();
        
        return response()->json($empl);
    }
    public function update(Request $request){
        

        $empl = Employee::find($request->id);

        if ($request->hasfile('image')) {
            $destination = 'employee_image/' . $request->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');

            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $randimg =  $file->move('employee_image/', $filename);

            $empl->image = $randimg;
        }
        $empl->employee_id = $request->employee_id;
        $empl->name = $request->name;
        $empl->doj = $request->doj;
        $empl->salary = $request->salary;
        $empl->gender = $request->gender;
        $empl->email = $request->email;
        $empl->phone = $request->phone;
        
        // $empl->image = ;
         $empl->save();
        return redirect()->back();
    }




//api operations 

public function emoloyee_register(Request $request)
    {
        $output_file = 'employee_image/';
        $output_file_with_extension = rand() . ".png";
        file_put_contents($output_file . $output_file_with_extension, base64_decode($request->image));
        $file_save_path = $output_file . $output_file_with_extension;

        $employee_data = new Employee;
        $employee_data->employee_id = $request->employee_id;
        $employee_data->name = $request->name;
        $employee_data->email  = $request->email;
        $employee_data->phone   = $request->phone;
        $employee_data->image  = $file_save_path;
        $employee_data->doj  = $request->doj;
        $employee_data->gender  = $request->gender;
        $employee_data->salary  = $request->salary;
        $employee_data->created_by  = $request->created_by;
       
        $employee_data->save();

        return response()->json([
            'employee_data' => $employee_data,
        
        ]);

    }

    public function fetch_employee_data($employee_id)
    {
        $employee = Employee::where('id', $employee_id)->first();
       

        if ($employee != null) {

            return response()->json([
                'data' => $employee
            ]);
        } else {
            return response()->json([
                'message' => 'Employee Not Found'
            ]);
        }
       
         
    }


    public function employee_edit(Request $request, $id)
    {

        $edit_data = Employee::findOrFail($id);

        if ($request->image == null) {
            $file_save_path = $edit_data->image;
        }

        if ($request->image != null) {

            $output_file1 = 'employee_image/';
            $output_file_with_extension1 = time() . ".png";
            file_put_contents($output_file1 . $output_file_with_extension1, base64_decode($request->image));
            $file_save_path = $output_file1 . $output_file_with_extension1;
         
        }
        
       
        $edit_data->employee_id = $request->employee_id;
        $edit_data->name = $request->name;
        $edit_data->email  = $request->email;
        $edit_data->phone   = $request->phone;
        $edit_data->image  = $file_save_path;
        $edit_data->doj  = $request->doj;
        $edit_data->gender  = $request->gender;
        $edit_data->salary  = $request->salary;
        $edit_data->created_by  = $request->created_by;
        $edit_data->save();

       
        return response()->json([
            'data' => $edit_data
            
        ]);
    }

    public function delete_employee_data($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return response()->json([
            'data' => $employee,
            'message' => 'Employee Delete Successfully'
        ]);
    }

}
