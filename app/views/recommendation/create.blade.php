@extends('layouts.master')

@section('main_content')

  <section class="segment -compact">
    <div class="wrapper">
      <h1 class="heading -alpha text-primary-color">Ask for a Recommendation</h1>
    {{ Form::open(['route' => 'recommendation.store']) }}

      {{-- This will be seen by the applicant --}}
      <p>Please fill all field with information for the recommender.</p><br>
      @for($i=0; $i<$num_recs; $i++)
        {{-- First Name --}}
        <div class="field-group">
          {{ Form::label('rec['.$i.'][first_name]', 'First Name: ') }}
          {{ Form::text('rec['.$i.'][first_name]') }}
          {{ errorsFor('rec['.$i.'][first_name]', $errors); }}
        </div>

        {{-- Last Name --}}
        <div class="field-group">
          {{ Form::label('rec['.$i.'][last_name]', 'Last Name: ') }}
          {{ Form::text('rec['.$i.'][last_name]') }}
          {{ errorsFor('rec['.$i.'][last_name]', $errors); }}
        </div>

        {{-- Email --}}
        <div class="field-group">
          {{ Form::label('rec['.$i.'][email]', 'Email: ') }}
          {{ Form::email('rec['.$i.'][email]') }}
          {{ errorsFor('rec['.$i.'][email]', $errors); }}
        </div>


        {{-- Phone Number --}}
        <div class="field-group">
          {{ Form::label('rec['.$i.'][phone]', 'Phone Number: ') }}
          {{ Form::text('rec['.$i.'][phone]') }}
          {{ errorsFor('rec['.$i.'][phone]', $errors); }}
        </div>
      @endfor

      {{-- Submit Button --}}
        {{ Form::submit('Send Email!', ['class' => 'button -default']) }}
      </div>


    {{ Form::close() }}
  </section>
@stop
