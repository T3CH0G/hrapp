@extends('layouts.app')

@section('content')
@if (Auth::guest())
<hr>
<h1> Please login </h1>
<hr>

@else

<h1> Date View </h1>
<h2>Name:</h2> 
<p>{{ $employee->name }}</p>
<h2>From: </h2> 
<p>{{ $date->from_date }}</p>
<h2>To: </h2> 
<p>{{ $date->to_date }}</p>

<div class="row">
    <div class="col-md-6">
        <a href="{{ route('dates.index') }}" class="btn btn-info">Back to all dates</a>
        <a href="{{ route('dates.edit', $date->id) }}" class="btn btn-primary">Edit Date</a>
    </div>
    <div class="col-md-6 text-right">
        {!! Form::open([
            'method' => 'DELETE',
            'route' => ['dates.destroy', $date->id]
        ]) !!}
            {!! Form::submit('Delete this date?', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>
</div>
<hr>

@endif
@stop