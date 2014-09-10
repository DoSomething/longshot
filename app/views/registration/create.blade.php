@extends('layouts.master')

@section('main_content')
  <section class="segment segment--register">
    <div class="wrapper">

      <h1 class="heading -alpha bg-primary-text">Create an Account</h1>

      <p>Have an account? {{ link_to_route('login', 'Login') }}</p>

      {{ Form::open(['route' => 'registration.store']) }}

        {{-- First Name Field --}}
        <div class="field-group -dual -alpha">
          {{ Form::label('first_name', 'First Name: ') }}
          {{ Form::text('first_name') }}
          {{ errorsFor('first_name', $errors); }}
        </div>

        {{-- Last Name Field --}}
        <div class="field-group -dual -beta">
          {{ Form::label('last_name', 'Last Name: ') }}
          {{ Form::text('last_name') }}
          {{ errorsFor('last_name', $errors); }}
        </div>

        {{-- Email Field --}}
        @include('layouts/partials/_form-email-field')

        {{-- Password Field --}}
        @include('layouts/partials/_form-password-field')

        {{-- Password Confirmation Field --}}
        @include('layouts/partials/_form-password-confirmation-field')

        {{-- Eligibility Check --}}
        <div class="field-group">
          {{ Form::checkbox('eligibility', 'eligible', false, ['id' => 'eligibility']); }}
          {{ Form::label('eligibility', 'Yes, I\'m eligible') }}
          <p><small>{{ $data->eligibility_text }}</small></p>
        </div>

        {{-- Submit Button --}}
        <div class="field-group">
          {{ Form::submit('Create Account', ['class' => 'button -default']) }}
        </div>

      {{ Form::close() }}

    </div>
  </section>
@stop
