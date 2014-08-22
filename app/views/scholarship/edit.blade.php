@extends('layouts.master')

@section('main_content')

  <h1>Edit Scholarship</h1>

  {{ Form::model($scholarship, ['method' => 'PATCH', 'route' => ['admin.scholarship.update', $scholarship->id]]) }}

    @include('scholarship/partials/_form_scholarship')

    {{-- Submit Button --}}
    <div>
      {{ Form::submit('Update scholarship') }}
    </div>

  {{ Form::close() }}

@stop
