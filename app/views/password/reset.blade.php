{{-- Password Reset --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Reset Password</h1>

    <div class="segment -compact">
      <div class="wrapper">

        <p>Set a new password for your account.</p>

        {{ Form::open() }}

          {{ Form::hidden('token', $token) }}

          {{-- Email Field --}}
          @include('layouts/partials/_form-email-field')

          {{-- Password Field --}}
          @include('layouts/partials/_form-password-field')

          {{-- Password Confirmation Field --}}
          @include('layouts/partials/_form-password-confirmation-field')

          {{-- Submit Button --}}
          <div class="field-group">
            {{ Form::submit('Submit', ['class' => 'button -default']) }}
          </div>

        {{ Form::close() }}

      </div>
    </div>

  </article>
@stop
