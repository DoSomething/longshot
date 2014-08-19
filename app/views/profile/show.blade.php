@extends('layouts.master')

@section('main_content')
  <h1>{{ $user->first_name }}'s Profile</h1>

  @if ($user->isCurrent())
    {{ link_to_route('profile.edit', 'Edit Your Profile', $user->id) }}
  @endif

  <p>{{ $user->profile->birthdate }}</p>
  <p>{{ $user->profile->phone }}</p>
  <p>{{ $user->profile->address_street }}, {{ $user->profile->address_premise }}</p>
  <p>{{ $user->profile->city }}, {{ $user->profile->state }} {{ $user->profile->zip }}</p>
  <p>{{ $user->profile->gender }}</p>
  <p>{{ $user->profile->race }}</p>
  <p>{{ $user->profile->school }}</p>
  <p>Grade: {{ $user->profile->grade }}</p>

@stop
