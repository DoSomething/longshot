{{-- Recommendation --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Recommendation</h1>

    <div class="segment -compact">
      <div class="wrapper">

      @if(isset($rank_values))
        {{-- This will be seen by the recommender --}}
        <p>Please fill all fields with information regarding the applicant.</p>

        @if (isset($vars->recommendation_update_help_text))
          <p>{!! $vars->recommendation_update_help_text !!}</p>
        @endif
      @endif

        {!! Form::model($recommendation, ['method' => 'PATCH', 'route' => ['recommendation.update', $recommendation->id]]) !!}

        <div class="clearfix">
          {{-- First Name --}}
          <div class="field-group -dual -alpha">
            {!! Form::label('first_name', 'Your First Name: ') !!}
            {!! Form::text('first_name', $recommendation->first_name) !!}
            {!! errorsFor('first_name', $errors); !!}
          </div>

          {{-- Last Name --}}
          <div class="field-group -dual -beta">
            {!! Form::label('last_name', 'Your Last Name: ') !!}
            {!! Form::text('last_name', $recommendation->last_name) !!}
            {!! errorsFor('last_name', $errors); !!}
          </div>
        </div>

        <div class="clearfix">
          {{-- Email --}}
          <div class="field-group -dual -alpha">
            {!! Form::label('email', 'Your Email: ') !!}
            {!! Form::email('email', $recommendation->email) !!}
            {!! errorsFor('email', $errors); !!}
          </div>

          {{-- Phone Number --}}
          <div class="field-group -dual -beta">
            {!! Form::label('phone', 'Your Phone Number (no dashes): ') !!}
            {!! Form::text('phone') !!}
            {!! errorsFor('phone', $errors) !!}
          </div>
        </div>

        @if(isset($rank_values))
          {{-- Rank Character --}}
          <div class="field-group">
            {!! Form::label('rank_character', $scholarship->label_rec_rank_character) !!}
            {!! Form::select('rank_character', $rank_values); !!}
            {!! errorsFor('rank_character', $errors); !!}
          </div>

          {{-- Rank Additional --}}
          <div class="field-group">
            {!! Form::label('rank_additional', $scholarship->label_rec_rank_additional) !!}
            {!! Form::select('rank_additional', $rank_values); !!}
            {!! errorsFor('rank_additional', $errors); !!}
          </div>

          {{-- Essay 1 --}}
          <div class="field-group">
            {!! Form::label('essay1', $scholarship->label_rec_essay1) !!}
            {!! Form::textarea('essay1') !!}
            {!! errorsFor('essay1', $errors); !!}
          </div>

          {{-- Optional Question --}}
          @if ($scholarship->display_optional_rec_question)
          <div class="field-group">
            {!! Form::label('optional_question', $scholarship->label_rec_optional_question) !!}
            {!! Form::text('optional_question') !!}
            {!! errorsFor('optional_question', $errors); !!}
          </div>
          @endif

          {{-- Submit Button --}}
          <div class="field-group">
            {!! Form::submit('Submit Recommendation', ['class' => 'button -default']) !!}
          </div>
        @endif

        {!! Form::close() !!}

      </div>
    </div>

  </article>
@stop
