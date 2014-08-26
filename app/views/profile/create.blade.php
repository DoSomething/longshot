@extends('layouts.master')

@section('main_content')
  <section class="segment">
    <h1 class="heading -alpha">Complete Your Profile</h1>

    {{ Form::open(['route' => 'profile.store']) }}

    @include('profile/partials/_form_profile')

    {{-- Submit Button --}}
    <div>
      {{ Form::submit('Save Profile', ['class' => 'btn -default']) }}
    </div>

  {{ Form::close() }}
  </section>
@stop
