@extends('layouts.app')

@section('content')
@if (Auth::guest())
<hr>
<h1> Please login </h1>
<hr>

@else

<h2> Employees </h2>
<hr>
@foreach($employees as $employee)
    <h3>Name: {{ $employee->name }}</h3>
    <h4>Amount of leave remaining: {{ $employee->leave_days }} days </h4>
    <p>
        <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info">View employee</a>
        <a href="{{ route('employees.edit', $employee->id) }}">edit</a>
    </p>
    <hr>
@endforeach
@endif
@stop