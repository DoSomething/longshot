@extends('layouts.master')

@section('main_content')
  <section class="segment segment--password">
    <div class="wrapper">

      <h1 class="heading -alpha bg-primary-text">Password Reminder</h1>

      <p>Please provide the email address that you used when you signed up to apply for the scholarship.</p>
      <p>We will send you an email that will allow you to reset your password.</p>

      {{ Form::open() }}

        {{-- Email Field --}}
        <div class="field-group">
          {{ Form::label('email', 'Email: ') }}
          {{ Form::email('email', null, ['required' => 'true']) }}
        </div>

        {{-- Submit Button --}}
        <div class="field-group">
          {{ Form::submit('Reset Password', ['class' => 'button -default']) }}
        </div>

      {{ Form::close() }}

    </div>
  </section>
@stop
