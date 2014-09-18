@extends('layouts.master')

@section('main_content')
  <section class="segment -compact">
    <div class="wrapper">

      <h1 class="heading -alpha">Basic Info</h1>

        {{ Form::open(['route' => 'profile.store']) }}

        @include('profile/partials/_form_profile')

        {{-- Submit Button --}}
        <div class="field-group">
          {{ Form::submit('Save', ['class' => 'button -default']) }}
        </div>

      {{ Form::close() }}

    </div>
  </section>
@stop
