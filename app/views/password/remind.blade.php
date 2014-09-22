{{-- Password Remind --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Forgot Password</h1>

    <div class="segment -compact">
      <div class="wrapper">

        <p>Please provide the email address that you used when you signed up to apply for a scholarship.</p>
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
    </div>

  </article>
@stop
