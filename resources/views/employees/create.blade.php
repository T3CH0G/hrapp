@extends('layouts.app')

@section('content')

@include('partials.alerts.errors')

@if (Auth::guest())
<hr>
<h1> Please login </h1>
<hr>

@else

<h1>Add a New Employee</h1>
<p class="lead">Add to your Employee list below.</p>
{!! Form::open([
    'route' => 'employees.store'
]) !!}

<div class="form-group">
    {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
    {!! Form::textarea('name', null, ['class' => 'form-control']) !!}
    {!! Form::label('leave_days', 'How many days of leave:', ['class' => 'control-label']) !!}
    {!! Form::number('leave_days', 14, ['class' => 'form-control']) !!}
</div>

{!! Form::submit('Create New Employees', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}
<hr>
@endif
@stop