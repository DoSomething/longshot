{{-- Profile Basic Info: Create --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Basic Info</h1>

    <div class="segment -compact">
      <div class="wrapper">

        {{ Form::open(['route' => 'profile.store']) }}

          <div class="progress"><strong>Step 1 of 3</strong></div>

          @include('profile/partials/_form_profile')

          {{-- Submit Button --}}
          <div class="field-group">
            {{ Form::submit('Save', ['class' => 'button -default']) }}
          </div>

        {{ Form::close() }}

      </div>
    </div>

  </article>
@stop
