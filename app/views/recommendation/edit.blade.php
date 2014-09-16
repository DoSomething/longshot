@extends('layouts.master')

@section('main_content')
  <section class="segment -compact">
    <div class="wrapper">

      <h1 class="heading -alpha text-primary-color">Edit Profile</h1>

      {{-- This will be seen by the recomender --}}
      <p>Please fill all fields with information regarding the applicant.</p>

      {{ Form::model($recommendation, ['method' => 'PATCH', 'route' => ['recommendation.update', $recommendation->id]]) }}

        {{-- First Name --}}
        <div class="field-group -dual -alpha">
          {{ Form::label('first_name', 'Your First Name: ') }}
          {{ Form::text('first_name', $recommendation->first_name, array('disabled')) }}
          {{ errorsFor('first_name', $errors); }}
        </div>

        {{-- Last Name --}}
        <div class="field-group -dual -beta">
          {{ Form::label('last_name', 'Your Last Name: ') }}
          {{ Form::text('last_name', $recommendation->last_name, array('disabled'))  }}
          {{ errorsFor('last_name', $errors); }}
        </div>

        {{-- Email --}}
        <div class="field-group -dual -alpha">
          {{ Form::label('email', 'Your Email: ') }}
          {{ Form::email('email', $recommendation->email, array('disabled')) }}
          {{ errorsFor('email', $errors); }}
        </div>


        {{-- Phone Number --}}
        <div class="field-group -dual -beta">
          {{ Form::label('phone', 'Your Phone Number: ') }}
          {{ Form::text('phone') }}
          {{ errorsFor('phone', $errors); }}
        </div>



        {{-- Rank Character --}}
        <div class="field-group">
          {{ Form::label('rank_character', $scholarship->label_rec_rank_character) }}
          {{ Form::text('rank_character') }}
          {{ errorsFor('rank_character', $errors); }}
        </div>

        {{-- Rank Additional --}}
        <div class="field-group">
          {{ Form::label('rank_addiational', $scholarship->label_rec_rank_additional) }}
          {{ Form::text('rank_addiational') }}
          {{ errorsFor('rank_addiational', $errors); }}
        </div>


        {{-- Essay1 --}}
        <div class="field-group">
          {{ Form::label('essay1', $scholarship->label_rec_essay1) }}
          {{ Form::textarea('essay1') }}
          {{ errorsFor('essay1', $errors); }}
        </div>

        {{-- Submit Button --}}
        <div class="field-group">
          {{ Form::submit('Update Profile', ['class' => 'button -default']) }}
        </div>

      {{ Form::close() }}

    </div>
  </section>
@stop
