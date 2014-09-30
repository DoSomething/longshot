{{-- Profile Basic Info: Create --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Basic Info</h1>

    <div class="segment -compact">
      <div class="wrapper">

        <p>{{ $help_text }}</p>

        {{ Form::open(['route' => 'profile.store']) }}

          <div class="progress"><strong>Step 1 of 2</strong></div>

          @include('profile/partials/_form_profile')


        {{-- Submit Button --}}
        <div class="field-group -action">
           {{ Form::submit('Save as Draft', ['class' => 'button -default -alpha', 'name' => 'draft']) }}
           {{ Form::submit('Save and Continue', ['class' => 'button -default -beta', 'name' => 'complete']) }}
        </div>

        {{ Form::close() }}

      </div>
    </div>

  </article>
@stop
