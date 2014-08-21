@extends('layouts.master')

@section('main_content')

  <h1>Edit Your Application</h1>

  {{ Form::model($user->application, ['method' => 'PATCH', 'route' => ['application.update', $user->id]]) }}

    @include('application/partials/_form_application')

    {{-- Submit Button --}}
    <div>
      {{ Form::submit('Update application') }}
    </div>

  {{ Form::close() }}

@stop
