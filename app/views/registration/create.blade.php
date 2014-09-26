{{-- Registration: Create --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Create an Account</h1>

    <div class="segment -compact">
      <div class="wrapper">

      <p>Have an account? {{ link_to_route('login', 'Login') }}</p>

      @if(isset($help_text))
        <p>{{ $help_text }}</p>
      @endif

      {{ Form::open(['route' => 'registration.store']) }}

          {{-- First Name Field --}}
          <div class="field-group -dual -alpha {{ setInvalidClass('first_name', $errors) }}">
            {{ Form::label('first_name', 'First Name: ') }}
            {{ Form::text('first_name') }}
            {{ errorsFor('first_name', $errors); }}
          </div>

          {{-- Last Name Field --}}
          <div class="field-group -dual -beta {{ setInvalidClass('last_name', $errors) }}">
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
          <div class="field-group -checkbox">
            <p><small>{{ $data->eligibility_text }}</small></p>
            {{ Form::checkbox('eligibility', 1, false, ['id' => 'eligibility']); }}
            {{ Form::label('eligibility', 'Yes, I\'m eligible') }}
            {{ errorsFor('eligibility', $errors); }}
          </div>

          {{-- Submit Button --}}
          <div class="field-group">
            {{ Form::submit('Create Account', ['class' => 'button -default']) }}
          </div>

        {{ Form::close() }}

      </div>
    </div>

  </article>
@stop
