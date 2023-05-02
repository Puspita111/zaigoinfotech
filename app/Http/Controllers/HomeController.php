<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\WhitelistIp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
   public function index(){


    return view('dashboard');
   }
   public function ipaddress_index(){
      $result=WhitelistIp::all();
      return view('ipaddress',compact('result'));
   }
   public function ipaddress_store(Request $request){
      $validate=Validator::make($request->all(),[
         'ip_address'=>'required|max:15'
      ],
      $message=[
         'ip_address.required'=>'Please Enter IP Address',
         'ip_address.max'=>'Please Enter a valid IP Address'
      ]
   );
      

   if($validate->fails()){
      return redirect()->back()->withErrors($validate);
   }
   else{
      $insert= new WhitelistIp;
      $insert->ip_address=$request->ip_address;
      $insert->save();
      return redirect('/ipaddress')->with('ip_success',"IP Address is whitelisted Successfully");
   }

   }
   public function updatestatus(Request $request){

      $update = WhitelistIp::find($request->id);
      $update->status = $request->status;
      $update->save();
      return response()->json([
         'status'=>200
      ]);
   }

   public function useractivity(){
      $user_log = DB::table('logs')
                  ->join('users','users.id','=','logs.user_id')
                  ->get();
      return view('useractivity',compact('user_log'));
   }
   
   public function sample_download (){
      $file=public_path().'/employee_bulk.csv';
      return Response::download($file);
   }
   public function employee_delete($id){
      Employee::find(Crypt::decrypt($id))->delete();

      return redirect()->back();


   }
  
}
