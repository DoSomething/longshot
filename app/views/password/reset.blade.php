@extends('layouts.master')

@section('main_content')
  <section class="segment segment--password">
    <div class="wrapper">

      <h1 class="heading -alpha bg-primary-text">Reset Password</h1>

      <p>Set a new password for your account.</p>

      {{ Form::open() }}
        {{ Form::hidden('token', $token) }}

        {{-- Email Field --}}
        <div class="field-group">
          {{ Form::label('email', 'Email: ') }}
          {{ Form::email('email') }}
        </div>

        {{-- Password Field --}}
        <div class="field-group">
          {{ Form::label('password', 'Password: ') }}
          {{ Form::password('password') }}
        </div>

        {{-- Password Confirmation Field --}}
        <div class="field-group">
          {{ Form::label('password_confirmation', 'Confirm Password: ') }}
          {{ Form::password('password_confirmation') }}
        </div>

        {{-- Submit Button --}}
        <div class="field-group">
          {{ Form::submit('Submit', ['class' => 'button -default']) }}
        </div>

      {{ Form::close() }}

    </div>
  </section>
@stop
