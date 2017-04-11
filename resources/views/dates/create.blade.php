@extends('layouts.app')

@section('content')

@include('partials.alerts.errors')

@if (Auth::guest())
<hr>
<h1> Please login </h1>
<hr>

@else

<h1>Add a New Leave Date</h1>
<p class="lead">Add to your Date list below.</p>
{!! Form::open([
    'route' => 'dates.store'
]) !!}

<div class="form-group">
    {!! Form::label('employee_id', 'Employee ID:', ['class' => 'control-label']) !!}
    {!! Form::select('employee_id', $q, ['class' => 'form-control']) !!}
    {!! Form::label('from_date', 'From:', ['class' => 'control-label']) !!}
    {!! Form::date('from_date', \Carbon\Carbon::now())!!}
    {!! Form::label('to_date', 'To:', ['class' => 'control-label']) !!}
    {!! Form::date('to_date', \Carbon\Carbon::now())!!}
</div>

{!! Form::submit('Create New Dates', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}
<hr>
@endif
@stop