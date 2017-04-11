<?php

namespace App\Http\Controllers;
use App\Employee;
use App\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class EmployeesController extends Controller
{
    public function index()
    {
    $employees = Employee::all();
    return view('employees.index',compact('employees'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $this->validate($request, [
        'name' => 'required',
        'leave_days' => 'required'
    ]);

    $input = $request->all();

    Employee::create($input);

    Session::flash('flash_message', 'Employee successfully added!');

    return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    $Employee = Employee::findOrFail($id);
    $Eid = $Employee->id;
    $Dates= Date::where('employee_id', $Eid)->get();
    return view('employees.show',compact('Dates'))->withEmployee($Employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Employees = Employee::findOrFail($id);
        return view('Employees.edit')->withEmployee($Employees);
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
    $Employee = Employee::findOrFail($id);

     $this->validate($request, [
        'name' => 'required',
        'leave_days' => 'required'
    ]);

    $input = $request->all();

    $Employee->fill($input)->save();

    Session::flash('flash_message', 'Employee successfully added!');

    return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $Employee = Employee::findOrFail($id);

    $Employee->delete();

    Session::flash('flash_message', 'Employee successfully deleted!');

    return redirect()->route('employees.index');
    }
}
