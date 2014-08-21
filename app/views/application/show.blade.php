@extends('layouts.master')

@section('main_content')
  <h1>{{ $user->first_name }}'s Application</h1>

  @if ($user->isCurrent())
    {{ link_to_route('application.edit', 'Edit Your Applicaiton', $user->id) }}
  @endif

  <p>{{ $user->application->accomplishments }}</p>
  <p>{{ $user->application->gpa }}</p>
  <p>{{ $user->application->test_type }} </p>
  <p>{{ $user->application->test_score }}</p>
  <p>{{ $user->application->activities }}</p>
  <p>{{ $user->application->essay1 }}</p>
  <p>{{ $user->application->essay2 }}</p>

@stop
