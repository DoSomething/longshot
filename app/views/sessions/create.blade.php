{{-- Login (Session): Create --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Login</h1>

    <div class="segment -compact">
      <div class="wrapper">

        {{ Form::open(['route' => 'sessions.store']) }}

          {{-- Email Field --}}
          @include('layouts.partials._form-email-field')

          {{-- Password Field --}}
          @include('layouts.partials._form-password-field')

          {{-- Submit Button --}}
          <div class="field-group">
            {{ Form::submit('Login', ['class' => 'button -default']) }}
          </div>

        {{ Form::close() }}

        <ul class="media-list">
          <li>{{ link_to_route('registration.create', 'Create an account') }}</li>
          <li><a href="/password/remind">Forgot Password</a></li>
        </ul>

      </div>
    </div>

  </article>
@stop
