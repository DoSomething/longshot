{{-- Profile Basic Info: Edit --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Edit Basic Info</h1>

    <div class="segment -compact">
      <div class="wrapper">

        {{ Form::model($user, ['method' => 'PATCH', 'route' => ['profile.update', $user->user_id]]) }}

          @include('profile/partials/_form_profile')

          {{-- Submit Button --}}
          <div>
            {{ Form::submit('Update', ['class' => 'button -default']) }}
          </div>

        {{ Form::close() }}

      </div>
    </div>

  </article>
@stop
