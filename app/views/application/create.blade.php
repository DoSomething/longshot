@extends('layouts.master')

@section('main_content')
  <section class="segment">
    <h1 class="heading -alpha">Complete Your Application</h1>

    {{ Form::open(['route' => 'application.store']) }}

    @include('application/partials/_form_application')

    {{-- Submit Button --}}
    <div>
      {{ Form::submit('Save application', ['class' => 'button -default']) }}
    </div>

    {{ Form::close() }}
  </section>
@stop
