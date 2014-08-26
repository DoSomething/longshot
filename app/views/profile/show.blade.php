@extends('layouts.master')

@section('main_content')
  <section class="segment">
    <h1 class="heading -alpha">{{ $user->first_name }}'s Profile</h1>

    <p>{{ $user->profile->birthdate }}</p>
    <p>{{ $user->profile->phone }}</p>
    <p>{{ $user->profile->address_street }}, {{ $user->profile->address_premise }}</p>
    <p>{{ $user->profile->city }}, {{ $user->profile->state }} {{ $user->profile->zip }}</p>
    <p>{{ $user->profile->gender }}</p>
    <p>{{ $user->profile->race }}</p>
    <p>{{ $user->profile->school }}</p>
    <p>Grade: {{ $user->profile->grade }}</p>

    @if ($user->isCurrent())
      <p>{{ link_to_route('profile.edit', 'Edit Your Profile', $user->id, ['class' => 'btn -default']) }}</p>
    @endif
  </section>
@stop
