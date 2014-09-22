{{-- Application: Create --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Your Application</h1>

    <div class="segment -compact">
      <div class="wrapper">

        {{ Form::open(['route' => 'application.store']) }}

          <div class="progress"><strong>Step 2 of 3</strong></div>

          @include('application/partials/_form_application')

          {{-- Submit Button --}}
          <div class="field-group">
            {{ Form::submit('Save as Draft', ['class' => 'button -default', 'name' => 'draft']) }}
            {{ Form::submit('Save and Continue', ['class' => 'button -default', 'name' => 'complete']) }}
          </div>

        {{ Form::close() }}

      </div>
    </div>

  </article>
@stop
