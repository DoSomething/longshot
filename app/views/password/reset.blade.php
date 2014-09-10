@extends('layouts.master')

@section('main_content')
  <section class="segment segment--password">
    <div class="wrapper">

      <h1 class="heading -alpha bg-primary-text">Reset Password</h1>

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
  </section>
@stop
