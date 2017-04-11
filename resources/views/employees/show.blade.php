@extends('layouts.app')

@section('content')
@if (Auth::guest())
<hr>
<h1> Please login </h1>
<hr>

@else

<h1> Employee View </h1>
<h2>Name:</h2> 
<p>{{ $employee->name }}</p>
<h2>Remaining leave days: </h2> 
<p>{{ $employee->leave_days }}</p>

<div class="row">
    <div class="col-md-6">
        <a href="{{ route('employees.index') }}" class="btn btn-info">Back to all employees</a>
        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary">Edit employee</a>
    </div>
    <div class="col-md-6 text-right">
        {!! Form::open([
            'method' => 'DELETE',
            'route' => ['employees.destroy', $employee->id]
        ]) !!}
            {!! Form::submit('Delete this employee?', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>
</div>
<hr>

<h2> Dates of Leave taken </h2>
@foreach ($Dates as $date)
<hr>
From {{$date->from_date}} to {{$date->to_date}}
<hr>
@endforeach

@endif
@stop