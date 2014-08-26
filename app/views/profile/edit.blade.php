@extends('layouts.master')

@section('main_content')
  <section class="segment">
    <h1 class="heading -alpha">Edit Profile</h1>

    {{ Form::model($user->profile, ['method' => 'PATCH', 'route' => ['profile.update', $user->id]]) }}

      @include('profile/partials/_form_profile')

      {{-- Submit Button --}}
      <div>
        {{ Form::submit('Update Profile', ['class' => 'btn -default']) }}
      </div>

    {{ Form::close() }}
  </section>
@stop
