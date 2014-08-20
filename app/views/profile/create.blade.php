@extends('layouts.master')

@section('main_content')

  <h1>Complete Your Profile</h1>

  {{ Form::open(['route' => 'profile.store']) }}

  @include('profile/partials/_form_profile')

  {{-- Submit Button --}}
  <div>
    {{ Form::submit('Save Profile') }}
  </div>

{{ Form::close() }}


@stop
