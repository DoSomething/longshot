@extends('layouts.master')

@section('main_content')
  <section class="segment -compact">
    <div class="wrapper">

      <h1 class="heading -alpha text-primary-color">Complete Your Application</h1>

        {{ Form::open(['route' => 'application.store']) }}

        @include('application/partials/_form_application')

        {{-- Submit Button --}}
        <div class="field-group">
        <input type="submit" name="draft" value="Save as Draft" class='button -default'>
        <input type="submit" name="complete" value="Submit" class='button -default'>
        </div>

      {{ Form::close() }}

    </div>
  </section>
@stop
