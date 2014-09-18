@extends('layouts.master')

@section('main_content')
  <section class="segment -compact">
    <div class="wrapper">

      <h1 class="heading -alpha text-primary-color">Edit Profile</h1>
      {{ Form::model($user, ['method' => 'PATCH', 'route' => ['profile.update', $user->user_id]]) }}

        @include('profile/partials/_form_profile')

        {{-- Submit Button --}}
        <div>
          {{ Form::submit('Update Profile', ['class' => 'button -default']) }}
        </div>

      {{ Form::close() }}

    </div>
  </section>
@stop
