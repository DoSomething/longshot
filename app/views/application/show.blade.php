{{-- Application: Show --}}
{{-- @TODO: Do we need this view? --}}

@extends('layouts.master')

@section('main_content')
  <section class="segment -compact">
    <div class="wrapper">

      <h1 class="heading -alpha text-primary-color">{{ $user->first_name }}'s Application</h1>

      @if ($user->isCurrent())
        {{ link_to_route('application.edit', 'Edit Your Applicaiton', $user->id, ['class' => 'button -default']) }}
      @endif

      {{-- @TODO: add all the user information here  --}}

      <p>{{ $user->application->accomplishments }}</p>
      <p>{{ $user->application->gpa }}</p>
      <p>{{ $user->application->test_type }} </p>
      <p>{{ $user->application->test_score }}</p>
      <p>{{ $user->application->activities }}</p>
      <p>{{ $user->application->essay1 }}</p>
      <p>{{ $user->application->essay2 }}</p>

    </div>
  </section>
@stop
