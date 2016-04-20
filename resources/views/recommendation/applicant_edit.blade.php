{{-- Reecommendation Request --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Ask for a Recommendation</h1>

    <div class="segment -compact">
      <div class="wrapper">

        {{-- This will be seen by the applicant --}}
        <p>Please fill all fields with information for the recommender.</p>

        @if (isset($vars->recommendation_update_help_text))
          <p>{{ $vars->recommendation_update_help_text }}</p>
        @endif

        {{ Form::model($recs, ['method' => 'PATCH', 'route' => ['recommendation.update', $user->id]]) }}

        {{ Form::hidden('app_id', $recs[0]['application_id']) }}

          @for($i = 0; $i < $num_recs['num_recommendations_max']; $i++)
            @if($num_recs['num_recommendations_max'] > 1)
              <h2 class="heading">
                Recommendation # {{ $i + 1 }}
                @if($num_recs['num_recommendations_min'] <= $i)
                  <em>(Optional)</em>
                @endif
              </h2>
            @endif
            @if (in_array(isset($recs[$i]) && $recs[$i]['id'], $complete_recs))
            {{ Form::hidden('rec['.$i.'][id]', $recs[$i]['id']) }}
            {{-- First Name --}}
            <div class="field-group -dual -alpha">
              {{ Form::label('rec['.$i.'][first_name]', 'First Name: ') }}
              {{ Form::text('rec['.$i.'][first_name]', $recs[$i]['first_name'], ['disabled']) }}
              {{ errorsFor('rec['.$i.'][first_name]', $errors) }}
            </div>

            {{-- Last Name --}}
            <div class="field-group -dual -beta">
              {{ Form::label('rec['.$i.'][last_name]', 'Last Name: ') }}
              {{ Form::text('rec['.$i.'][last_name]', $recs[$i]['last_name'], ['disabled'])  }}
              {{ errorsFor('rec['.$i.'][last_name]', $errors) }}
            </div>

            {{-- Email --}}
            <div class="field-group -dual -alpha">
              {{ Form::label('rec['.$i.'][email]', 'Email: ') }}
              {{ Form::email('rec['.$i.'][email]', $recs[$i]['email'], ['disabled']) }}
              {{ errorsFor('rec['.$i.'][email]', $errors) }}
            </div>

            {{-- Phone Number --}}
            <div class="field-group -dual -beta">
              {{ Form::label('rec['.$i.'][phone]', 'Phone Number: ') }}
              {{ Form::text('rec['.$i.'][phone]', $recs[$i]['phone'], ['disabled']) }}
              {{ errorsFor('rec['.$i.'][phone]', $errors) }}
            </div>

             {{-- Relationship --}}
            <div class="field-group -mono">
              {{ Form::label('rec['.$i.'][relationship]', 'Relationship to you: ') }}
              {{ Form::text('rec['.$i.'][relationship]', $recs[$i]['relationship'], ['disabled']) }}
              {{ errorsFor('rec['.$i.'][relationship]', $errors) }}
            </div>

            @elseif (isset($recs[$i]))
            {{ Form::hidden('rec['.$i.'][id]', $recs[$i]['id']) }}
              {{-- First Name --}}
            <div class="field-group -dual -alpha">
              {{ Form::label('rec['.$i.'][first_name]', 'First Name: ') }}
              {{ Form::text('rec['.$i.'][first_name]', $recs[$i]['first_name']) }}
              {{ errorsFor('rec['.$i.'][first_name]', $errors) }}
            </div>

            {{-- Last Name --}}
            <div class="field-group -dual -beta">
              {{ Form::label('rec['.$i.'][last_name]', 'Last Name: ') }}
              {{ Form::text('rec['.$i.'][last_name]', $recs[$i]['last_name'])  }}
              {{ errorsFor('rec['.$i.'][last_name]', $errors) }}
            </div>

            {{-- Email --}}
            <div class="field-group -dual -alpha">
              {{ Form::label('rec['.$i.'][email]', 'Email: ') }}
              {{ Form::email('rec['.$i.'][email]', $recs[$i]['email']) }}
              {{ errorsFor('rec['.$i.'][email]', $errors) }}
            </div>

            {{-- Phone Number --}}
            <div class="field-group -dual -beta">
              {{ Form::label('rec['.$i.'][phone]', 'Phone Number: ') }}
              {{ Form::text('rec['.$i.'][phone]', $recs[$i]['phone']) }}
              {{ errorsFor('rec['.$i.'][phone]', $errors) }}
            </div>

             {{-- Relationship --}}
            <div class="field-group -mono">
              {{ Form::label('rec['.$i.'][relationship]', 'Relationship to you: ') }}
              {{ Form::text('rec['.$i.'][relationship]', $recs[$i]['relationship']) }}
              {{ errorsFor('rec['.$i.'][relationship]', $errors) }}
            </div>

            @else
              {{-- First Name --}}
              <div class="field-group -dual -alpha">
                {{ Form::label('rec['.$i.'][first_name]', 'First Name: ') }}
                {{ Form::text('rec['.$i.'][first_name]') }}
                {{ errorsFor('rec['.$i.'][first_name]', $errors) }}
              </div>

              {{-- Last Name --}}
              <div class="field-group -dual -beta">
                {{ Form::label('rec['.$i.'][last_name]', 'Last Name: ') }}
                {{ Form::text('rec['.$i.'][last_name]') }}
                {{ errorsFor('rec['.$i.'][last_name]', $errors) }}
              </div>

              {{-- Email --}}
              <div class="field-group -dual -alpha">
                {{ Form::label('rec['.$i.'][email]', 'Email: ') }}
                {{ Form::email('rec['.$i.'][email]') }}
                {{ errorsFor('rec['.$i.'][email]', $errors) }}
              </div>

              {{-- Phone Number --}}
              <div class="field-group -dual -beta">
                {{ Form::label('rec['.$i.'][phone]', 'Phone Number: ') }}
                {{ Form::text('rec['.$i.'][phone]') }}
                {{ errorsFor('rec['.$i.'][phone]', $errors) }}
              </div>

               {{-- Relationship --}}
              <div class="field-group -mono">
                {{ Form::label('rec['.$i.'][relationship]', 'Relationship to you: ') }}
                {{ Form::text('rec['.$i.'][relationship]') }}
                {{ errorsFor('rec['.$i.'][relationship]', $errors) }}
              </div>
            @endif


          @endfor

          {{-- Submit Button --}}
          <div class="field-group">
            {{ Form::submit('Update Requests!', ['class' => 'button -default']) }}
          </div>

        {{ Form::close() }}

      </div>
    </div>

  </article>
@stop
