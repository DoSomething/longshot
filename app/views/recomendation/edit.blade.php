@extends('layouts.master')

@section('main_content')

  <h1>Edit Profile</h1>

  {{ Form::model($application->recommendation, ['method' => 'PATCH', 'route' => ['recommendation.update', $application->id]]) }}

    {{-- This will be seen by the recomender --}}

    {{-- Submit Button --}}
    <div>
      {{ Form::submit('Update Profile') }}
    </div>

  {{ Form::close() }}

@stop
