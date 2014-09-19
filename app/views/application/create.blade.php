@extends('layouts.master')

@section('main_content')
  <section class="segment -compact">
    <div class="wrapper">

      <h1 class="heading -alpha text-primary-color">Your Application</h1>

        {{ Form::open(['route' => 'application.store']) }}

        @include('application/partials/_form_application')

        {{-- Submit Button --}}
        <div class="field-group">
          {{ Form::submit('Save as Draft', ['class' => 'button -default', 'name' => 'draft']) }}
          {{ Form::submit('Save and Continue', ['class' => 'button -default', 'name' => 'complete']) }}
        </div>

      {{ Form::close() }}

    </div>
  </section>
@stop
