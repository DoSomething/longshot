@extends('layouts.master')

@section('main_content')
  <section class="segment -compact">
    <div class="wrapper">

      <h1 class="heading -alpha text-primary-color">Password Reminder</h1>

      <p>Please provide the email address that you used when you signed up to apply for the scholarship.</p>
      <p>We will send you an email that will allow you to reset your password.</p>

      {{ Form::open() }}

        {{-- Email Field --}}
        @include('layouts/partials/_form-email-field')

        {{-- Submit Button --}}
        <div class="field-group">
          {{ Form::submit('Reset Password', ['class' => 'button -default']) }}
        </div>

      {{ Form::close() }}

    </div>
  </section>
@stop
