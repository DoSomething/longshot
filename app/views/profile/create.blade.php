@extends('layouts.master')

@section('main_content')
  <section class="segment -compact">
    <div class="wrapper">

      <h1 class="heading -alpha">Complete Your Profile</h1>

        {{ Form::open(['route' => 'profile.store']) }}

        @include('profile/partials/_form_profile')

        {{-- Submit Button --}}
        <div class="field-group">
          {{ Form::submit('Save Profile', ['class' => 'button -default']) }}
        </div>

      {{ Form::close() }}

    </div>
  </section>
@stop
