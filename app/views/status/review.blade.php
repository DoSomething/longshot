{{-- Status --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Review & Submit</h1>
    <p> {{ $help_text }} </p>
    {{ Form::open(['route' => 'review.store']) }}

    <h3> Basic Info </h3>
    @foreach ($profile as $key => $field)
      @if (!empty($field))
       <h4> {{ $key }} : </h4>
       {{ $field }}
      @endif
    @endforeach

    <h3> Application </h3>
    @foreach ($application as $key => $field)
     {{-- did the have a value in the field --}}
      @if (!empty($field))
      {{-- does the field have a better title in the scholarship? --}}
      @if (isset($scholarship[$key]))
       <h4> {{ $scholarship[$key] }} : </h4>
       @else
        <h4> {{ $key }} </h4>
       @endif

       {{ $field }}
      @endif
    @endforeach


  {{-- Checklist --}}
  <div class="field-group -checkbox">
    {{ Form::checkbox('documentation', 1, false, ['id' => 'eligibility']); }}
    {{ Form::label('documentation', "If you are chosen as a winner, you will submit a copy of your driver's license, birth certificate or passport as proof of age and U.S. citizenship/permanent legal resident status.") }}
    {{ errorsFor('documentation', $errors); }}
  </div>

  <div class="field-group -checkbox">
    {{ Form::checkbox('factual', 1, false, ['id' => 'eligibility']); }}
    {{ Form::label('factual', "You confirm that everything written in the application is true and factual.") }}
    {{ errorsFor('factual', $errors); }}
  </div>

  <div class="field-group -checkbox">
    {{ Form::checkbox('media_release', 1, false, ['id' => 'eligibility']); }}
    {{ Form::label('media_release', "Foot Locker and TMI may use your application in any media or public relations campaigns.") }}
    {{ errorsFor('media_release', $errors); }}
  </div>

  <div class="field-group -checkbox">
    {{ Form::checkbox('rules', 1, false, ['id' => 'eligibility']); }}
    {{ Form::label('rules', "You agree to the Official Rules [link]") }}
    {{ errorsFor('rules', $errors); }}
  </div>

    {{ Form::submit('Submit application', ['class' => 'button -default', 'name' => 'complete']) }}
    {{ Form::close() }}

    <div class="contact">
      <p>Need help? <a href="mailto:gthomas@tmiagency.org">Contact Us</a></p>
    </div>

  </article>
@stop
