@extends('layouts.app')

@section('content')

@if (Auth::guest())
<hr>
<h1> Please login </h1>
<hr>

@else

<h1>Editing "{{ $employee->content }}"</h1>
<p class="lead">Edit and save this employee below, or <a href="{{ route('employees.index') }}">go back to all employees.</a></p>
<hr>

@include('partials.alerts.errors')

{!! Form::model($employee, [
    'method' => 'PATCH',
    'route' => ['employees.update', $employee
   ->id]
]) !!}


<div class="form-group">
    {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
    {!! Form::textarea('name', null, ['class' => 'form-control']) !!}
    {!! Form::label('leave_days', 'How many days of leave:', ['class' => 'control-label']) !!}
    {!! Form::number('leave_days', 14, ['class' => 'form-control']) !!}
</div>

{!! Form::submit('Update employee', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}
@endif
@stop