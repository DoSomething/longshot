@extends('layouts.master')

@section('main_content')
  <section class="segment">
    <h1 class="heading -alpha">Create an Account</h1>

    <p>Have an account? {{ link_to_route('login', 'Login') }}</p>

    {{ Form::open(['route' => 'registration.store']) }}

      {{-- First Name Field --}}
      <div class="field-group">
        {{ Form::label('first_name', 'First Name: ') }}
        {{ Form::text('first_name') }}
        {{ errorsFor('first_name', $errors); }}
      </div>

      {{-- Last Name Field --}}
      <div class="field-group">
        {{ Form::label('last_name', 'Last Name: ') }}
        {{ Form::text('last_name') }}
        {{ errorsFor('last_name', $errors); }}
      </div>

      {{-- Email Field --}}
      <div class="field-group">
        {{ Form::label('email', 'Email: ') }}
        {{ Form::email('email') }}
        {{ errorsFor('email', $errors); }}
      </div>

      {{-- Password Field --}}
      <div class="field-group">
        {{ Form::label('password', 'Password: ') }}
        {{ Form::password('password') }}
        {{ errorsFor('password', $errors); }}
      </div>

      {{-- Password Confirmation Field --}}
      <div class="field-group">
        {{ Form::label('password_confirmation', 'Confirm Password: ') }}
        {{ Form::password('password_confirmation') }}
      </div>

      {{-- Eligibility Check --}}
      <div class="field-group">
        {{ Form::checkbox('eligibility', 'eligible', false, ['id' => 'eligibility']); }}
        {{ Form::label('eligibility', 'Yes, I\'m eligible') }}
        <p><small>Eligibility requirements ipsum dolor sit amet, consectetur. Et, iste adipisicing elit.</small></p>
      </div>

      {{-- Submit Button --}}
      <div class="field-group">
        {{ Form::submit('Create Account', ['class' => 'button -default']) }}
      </div>

    {{ Form::close() }}
  </section>
@stop
