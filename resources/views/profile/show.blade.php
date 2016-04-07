{{-- Profile Basic Info: Show --}}
{{-- @TODO: Do we need this view? --}}

@extends('layouts.master')

@section('main_content')
  <section class="segment -compact">
    <div class="wrapper">

      <h1 class="heading -alpha text-primary-color">{{ $user->first_name }}'s Profile</h1>

      <div class="">
        <p><strong>Birthdate:</strong> {{ $user->profile->birthdate }}</p>
        <p><strong>Phone Number:</strong>{{ $user->profile->phone }}</p>
        <p><strong>Street Address:</strong>{{ $user->profile->address_street }}, {{ $user->profile->address_premise }}</p>
        <p><strong>City, State, Zip:</strong>{{ $user->profile->city }}, {{ $user->profile->state }} {{ $user->profile->zip }}</p>
        <p><strong>Gender:</strong>{{ $user->profile->gender }}</p>
        <p><strong>Race:</strong>{{ $user->profile->race }}</p>
        <p><strong>School:</strong>{{ $user->profile->school }}</p>
        <p><strong>Grade:</strong> {{ $user->profile->grade }}</p>
      </div>

      @if ($user->isCurrent())
        {{ link_to_route('profile.edit', 'Edit Your Profile', $user->id, ['class' => 'button -default']) }}
      @endif

    </div>
  </section>
@stop
