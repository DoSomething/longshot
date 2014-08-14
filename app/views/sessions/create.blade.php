@extends('layouts.master')

@section('main_content')

  <h1>Login</h1>

  {{ Form::open(['route' => 'sessions.store']) }}

    {{-- Email Field --}}
    <div>
      {{ Form::label('email', 'Email: ') }}
      {{ Form::email('email') }}
      {{ errorsFor('email', $errors); }}
    </div>

    {{-- Password Field --}}
    <div>
      {{ Form::label('password', 'Password: ') }}
      {{ Form::password('password') }}
      {{ errorsFor('password', $errors); }}
    </div>

    {{-- Submit Button --}}
    <div>
      {{ Form::submit('Login') }}
    </div>

  {{ Form::close() }}

@stop
