{{-- Recommendation Request --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Ask for a Recommendation</h1>

    <div class="segment -compact">
      <div class="wrapper">

        {{-- This will be seen by the applicant --}}
        <p>Please fill all fields with information for the recommender.</p>

        @if (isset($vars->recommendation_create_help_text))
          <p>{{ $vars->recommendation_create_help_text }}</p>
        @endif

        {!! Form::open(['route' => 'recommendation.store']) !!}

          @for($i = 0; $i < $num_recs['num_recommendations_max']; $i++)
            @if($num_recs['num_recommendations_max'] > 1)
              <h2 class="heading">
                Recommendation # {{ $i + 1 }}
                @if($num_recs['num_recommendations_min'] <= $i)
                  <em>(Optional)</em>
                @endif
              </h2>
            @endif

            {{-- First Name --}}
            <div class="field-group -dual -alpha">
              {!! Form::label('rec['.$i.'][first_name]', 'First Name: ') !!}
              {!! Form::text('rec['.$i.'][first_name]') !!}
              {{-- @TODO: will need a different method of showing errors, since these fields are dynamic and we can't use the ValidationService --}}
              {!! errorsFor('rec['.$i.'][first_name]', $errors) !!}
            </div>

            {{-- Last Name --}}
            <div class="field-group -dual -beta">
              {!! Form::label('rec['.$i.'][last_name]', 'Last Name: ') !!}
              {!! Form::text('rec['.$i.'][last_name]') !!}
              {{-- @TODO: will need a different method of showing errors, since these fields are dynamic and we can't use the ValidationService --}}
              {!! errorsFor('rec['.$i.'][last_name]', $errors) !!}
            </div>

            {{-- Email --}}
            <div class="field-group -dual -alpha">
              {!! Form::label('rec['.$i.'][email]', 'Email: ') !!}
              {!! Form::email('rec['.$i.'][email]') !!}
              {{-- @TODO: will need a different method of showing errors, since these fields are dynamic and we can't use the ValidationService --}}
              {!! errorsFor('rec['.$i.'][email]', $errors) !!}
            </div>

            {{-- Phone Number --}}
            <div class="field-group -dual -beta">
              {!! Form::label('rec['.$i.'][phone]', 'Phone Number: ') !!}
              {!! Form::text('rec['.$i.'][phone]') !!}
              {{-- @TODO: will need a different method of showing errors, since these fields are dynamic and we can't use the ValidationService --}}
              {!! errorsFor('rec['.$i.'][phone]', $errors) !!}
            </div>

             {{-- Relationship --}}
            <div class="field-group -mono">
              {!! Form::label('rec['.$i.'][relationship]', 'Relationship to you: ') !!}
              {!! Form::text('rec['.$i.'][relationship]') !!}
              {!! errorsFor('rec['.$i.'][relationship]', $errors) !!}
            </div>
          @endfor

          {{-- Submit Button --}}
          <div class="field-group">
            {!! Form::submit('Send Request!', ['class' => 'button -default']) !!}
          </div>

        {!! Form::close() !!}

      </div>
    </div>

  </article>
@stop
