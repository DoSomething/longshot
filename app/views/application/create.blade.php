{{-- Application: Create --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Your Application</h1>

    <div class="segment -compact">
      <div class="wrapper">

        <p>{{ $help_text }}</p>

        {{ Form::open(['route' => 'application.store', 'class' => 'form--application']) }}

          <div class="progress"><strong>Step 2 of 2</strong></div>

          @include('application/partials/_form_application')

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
