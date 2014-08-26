@extends('layouts.master')

@section('main_content')
  <section class="segment">
    <h1 class="heading -alpha">Ask for a Recommendation</h1>
    {{ Form::open(['route' => 'recommendation.store']) }}

      {{-- This will be seen by the applicant --}}
      <p>Please fill all field with information for the recommender.</p><br>
      {{-- First Name --}}
      <div class="field-group">
        {{ Form::label('first_name', 'First Name: ') }}
        {{ Form::text('first_name') }}
        {{ errorsFor('first_name', $errors); }}
      </div>

      {{-- Last Name --}}
      <div class="field-group">
        {{ Form::label('last_name', 'Last Name: ') }}
        {{ Form::text('last_name') }}
        {{ errorsFor('last_name', $errors); }}
      </div>

      {{-- Email --}}
      <div class="field-group">
        {{ Form::label('email', 'Email: ') }}
        {{ Form::email('email') }}
        {{ errorsFor('email', $errors); }}
      </div>


      {{-- Phone Number --}}
      <div class="field-group">
        {{ Form::label('phone', 'Phone Number: ') }}
        {{ Form::text('phone') }}
        {{ errorsFor('phone', $errors); }}
      </div>


      {{-- Submit Button --}}
      <div class="field-group">
        {{ Form::submit('Send Email!', ['class' => 'btn -default']) }}
      </div>

    {{ Form::close() }}
  </section>
@stop
