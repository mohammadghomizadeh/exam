<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Support\Facades\Log;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $employees = Employee::with('company')->paginate(10);
        // dd($employees);
       return view('admin.employee.index',compact('employees',$employees));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('admin.employee.create',compact('companies',$companies));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
        ]);
            $employee = new Employee([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'company_id' => $request->company,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            $employee->save();
            return redirect('/Employees')->with('success', 'Employees saved!');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $employee = Employee::find($id)->with('company')->first();;
        
        $companies = Company::all();
        return view('admin.employee.edit',compact('employee','companies',$employee,$companies));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
        ]);


            $employee = Employee::find($id);
            $employee->firstname = $request->firstname;
            $employee->lastname = $request->lastname;
            $employee->company_id = $request->company;
            $employee->email = $request->email;
            $employee->phone = $request->phone;

            $employee->save();
            return redirect('/Employees')->with('success', 'Employees Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect('/Employees')->with('Deleted', 'Employee Deleted..!');
    }
}
