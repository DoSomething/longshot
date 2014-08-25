@extends('layouts.master')

@section('main_content')

  <h1>Create a new Scholarship</h1>

  {{ Form::open(['route' => 'admin.scholarship.store']) }}

  @include('scholarship/partials/_form_scholarship')

  {{-- Submit Button --}}
  <div>
    {{ Form::submit('Save Scholarship') }}
  </div>

{{ Form::close() }}


@stop
