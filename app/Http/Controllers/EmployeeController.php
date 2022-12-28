<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


     public function index(){

         $employees = Employee::paginate(5);
          //dd("hello");
         return response()->json($employees);
     }

     public function store(Request $request){

         $employees = Employee::insert([

              'name' => $request->input('name'),
              'address' => $request->input('address'),
              'mobile' => $request->input('mobile'),
         ]);

         return response()->json('Employee Created');
     }
     public function show($id){

         $employees = Employee::find($id);
         return response()->json($employees);
     }

     public function update(Request $request, $id){

          $employees = Employee::find($id)->update($request->all());
          //dd('hello');
          return response()->json('Employee Updated');
     }

     public function delete($id){
        
        $delete = Employee::find($id)->delete();

        return response()->json('Employee Deleted');
     }
}
