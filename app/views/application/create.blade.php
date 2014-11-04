{{-- Application: Create --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Your Application</h1>

    <div class="segment -compact">
      <div class="wrapper">

        <div class="progress"><strong>Step 2 of 2</strong></div>

        @if (!empty($vars->application_create_help_text))
          <p>{{ $vars->application_create_help_text }}</p>
        @endif

        {{ Form::open(['route' => 'application.store', 'class' => 'form--application']) }}

          @include('application/partials/_form_application')

          {{-- Submit Button --}}
          <div class="field-group -action">
            {{ Form::submit('Save and Continue', ['class' => 'button -default', 'name' => 'complete']) }}
            {{ Form::submit('or Save as Draft', ['class' => 'button -link', 'name' => 'draft']) }}
          </div>

        {{ Form::close() }}

      </div>
    </div>

  </article>
@stop
