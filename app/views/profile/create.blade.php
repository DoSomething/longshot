{{-- Profile Basic Info: Create --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Basic Info</h1>

    <div class="segment -compact">
      <div class="wrapper">

        <div class="progress"><strong>Step 1 of 2</strong></div>

        @if (!empty($vars->basic_info_help_text))
          <p>{{ $vars->basic_info_help_text }}</p>
        @endif

        {{ Form::open(['route' => 'profile.store']) }}

          @include('profile/partials/_form_profile')

          {{-- Submit Button --}}
          <div class="field-group -action">
            {{ Form::submit('Save as Draft', ['class' => 'button -link', 'name' => 'draft']) }}
            {{ Form::submit('Save and Continue', ['class' => 'button -default', 'name' => 'complete']) }}
          </div>

        {{ Form::close() }}

      </div>
    </div>

  </article>
@stop
