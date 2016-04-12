{{-- User Info: Edit --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Edit Account Info</h1>

    <div class="segment -compact">
      <div class="wrapper">

        {!! Form::model($user, ['method' => 'PUT', 'route'=> ['registration.update', $user->id]]) !!}

          {{-- First Name Field --}}
          <div class="field-group -dual -alpha {{ setInvalidClass('first_name', $errors) }}">
            {!! Form::label('first_name', 'First Name: ') !!}
            {!! Form::text('first_name') !!}
            {!! errorsFor('first_name', $errors) !!}
          </div>

          {{-- Last Name Field --}}
          <div class="field-group -dual -beta {{ setInvalidClass('last_name', $errors) }}">
            {!! Form::label('last_name', 'Last Name: ') !!}
            {!! Form::text('last_name') !!}
            {!! errorsFor('last_name', $errors) !!}
          </div>

          <div class="field-group {{ setInvalidClass('email', $errors) }}">
            {!! Form::label('email', 'Email: ') !!}
            {!! Form::email('email') !!}
            {!! errorsFor('email', $errors) !!}
          </div>

          {!! Form::hidden('password', $user->password) !!}
          {!! Form::hidden('password_confirmation', $user->password) !!}
          {!! Form::hidden('eligibility', TRUE) !!}

          {{-- Submit Button --}}
          <div class="field-group">
            {!! Form::submit('Update Account', ['class' => 'button -default']) !!}
          </div>

        {!! Form::close() !!}

      </div>
    </div>

  </article>
@stop
