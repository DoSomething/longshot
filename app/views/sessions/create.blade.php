@extends('layouts.master')

@section('main_content')
  <section class="segment segment--login">
    <div class="wrapper">

      <h1 class="heading -alpha bg-primary-text">Login</h1>

      {{ Form::open(['route' => 'sessions.store']) }}

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

        {{-- Submit Button --}}
        <div class="field-group">
          {{ Form::submit('Login', ['class' => 'button -default']) }}
        </div>

      {{ Form::close() }}

      <ul class="media-list">
        <li>{{ link_to_route('registration.create', 'Create an account') }}</li>
        <li><a href="#">Forgot Password</a></li>
      </ul>

    </div>
  </section>
@stop
