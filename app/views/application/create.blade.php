@extends('layouts.master')

@section('main_content')

  <h1>Complete Your Application</h1>

  {{ Form::open(['route' => 'application.store']) }}

  @include('application/partials/_form_application')

  {{-- Submit Button --}}
  <div>
    {{ Form::submit('Save application') }}
  </div>

{{ Form::close() }}


@stop
