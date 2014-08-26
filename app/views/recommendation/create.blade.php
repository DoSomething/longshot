@extends('layouts.master')

@section('main_content')

  <h1>Ask for a recommendation</h1>
  {{ Form::open(['route' => 'recommendation.store']) }}

  {{-- This will be seen by the applicant --}}
  Please fill all field with information for the recommender.
  {{-- First Name --}}
  <div>
    {{ Form::label('first_name', 'First Name: ') }}
    {{ Form::text('first_name') }}
    {{ errorsFor('first_name', $errors); }}
  </div>

  {{-- Last Name --}}
  <div>
    {{ Form::label('last_name', 'Last Name: ') }}
    {{ Form::text('last_name') }}
    {{ errorsFor('last_name', $errors); }}
  </div>

  {{-- Email --}}
  <div>
    {{ Form::label('email', 'Email: ') }}
    {{ Form::email('email') }}
    {{ errorsFor('email', $errors); }}
  </div>


  {{-- Phone Number --}}
  <div>
    {{ Form::label('phone', 'Phone Number: ') }}
    {{ Form::text('phone') }}
    {{ errorsFor('phone', $errors); }}
  </div>


  {{-- Submit Button --}}
  <div>
    {{ Form::submit('Send Email!') }}
  </div>

{{ Form::close() }}


@stop
