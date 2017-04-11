<?php

namespace App\Http\Controllers;
use App\Date;
use App\Employee;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DatesController extends Controller
{
    public function index()
    {
    $dates = Date::all();
    return view('dates.index',compact('dates'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$employees = Employee::all();
        $q = [];
        foreach ($employees as $employee)
            {
                array_push($q,[($employee->id)=>($employee->name)]);
            }
        return view('dates.create',compact('q'));
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
        'from_date' => 'required',
        'to_date' => 'required',
        'employee_id' => 'required'
    ]);

    $input = $request->all();
    $start = Carbon::parse($request->input('from_date'));
    $end = Carbon::parse($request->input('to_date'));
    $length = $end->diffInDays($start);
    $employee_id = $request->employee_id;
    $leave = DB::table('employees')->where('id', $employee_id)->value('leave_days');
    $leave = $leave - $length;
    $update = DB::table('employees')->where('id', $employee_id);
    $update->update(['leave_days' => $leave]);


    Date::create($input);

    Session::flash('flash_message', 'Date successfully added!');

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
    $date = Date::findOrFail($id);
	$eid=$date->employee_id;
    $employee=Employee::findOrFail($eid);
    return view('dates.show',compact('employee'))->withDate($date);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $date = Date::findOrFail($id);
        return view('dates.edit')->withDate($date);
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
    $date = Date::findOrFail($id);

     $this->validate($request, [
        'from_date' => 'required',
        'to_date' => 'required',
        'leave_days' => 'required'
    ]);

    $input = $request->all();

    $date->fill($input)->save();

    Session::flash('flash_message', 'Date successfully added!');

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
    $date = Date::findOrFail($id);

    $date->delete();

    Session::flash('flash_message', 'Date successfully deleted!');

    return redirect()->route('dates.index');
    }
}
