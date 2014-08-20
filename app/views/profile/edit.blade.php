@extends('layouts.master')

@section('main_content')

  <h1>Edit Profile</h1>

  {{ Form::model($user->profile, ['method' => 'PATCH', 'route' => ['profile.update', $user->id]]) }}

    @include('profile/partials/_form_profile')

    {{-- Submit Button --}}
    <div>
      {{ Form::submit('Update Profile') }}
    </div>

  {{ Form::close() }}

@stop
