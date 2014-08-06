@extends('layouts.master')

@section('main_content')
  <h1>Application</h1>

  <p>Here the main application page with the forms to fill out.</p>
  <p><em>Form would need to happen over multiple stages. Likely split the form into partials than can be Ajax loaded per step.</em></p>

  <div>
    <p>Current Progress: <progress max="100" value="25">25%</progress></p>
  </div>

  {{ Form::open(array('url' => '/application')) }}

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
      {{ Form::checkbox('legal', 'agree') }}
      {{ Form::label('legal', 'I agree to the Terms &amp; Conditions.') }}
    </div>

    <div class="">
      {{ Form::submit('Submit Application') }}
    </div>

  {{ Form::close() }}
@stop
