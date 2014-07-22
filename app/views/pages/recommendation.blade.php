@extends('layouts.master')

@section('main_content')
	<h1>Recommendation</h1>

  {{ Form::open(array('url' => '/recommendation')) }}

    <div class="">
      {{ Form::label('first_name', 'First Name', array('class' => 'first-name')) }}
      {{ Form::text('first_name') }}
    </div>

    <div class="">
      {{ Form::label('last_name', 'Last Name', array('class' => 'last-name')) }}
      {{ Form::text('last_name') }}
    </div>

    <div class="">
      {{ Form::label('email', 'Email', array('class' => 'email')) }}
      {{ Form::text('email') }}
    </div>

    <div class="">
      {{ Form::submit('Request Recommendation') }}
    </div>

  {{ Form::close() }}
@stop
