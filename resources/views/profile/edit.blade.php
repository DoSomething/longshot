{{-- Profile Basic Info: Edit --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Edit Basic Info</h1>

    <div class="segment -compact">
      <div class="wrapper">

        <p>{!! $vars->basic_info_help_text or 'All fields are required, unless (optional) is written next to it.' !!}</p>

        {!! Form::model($user, ['method' => 'PATCH', 'route' => ['profile.update', $user->user_id]]) !!}

          @include('profile/partials/_form_profile')

          {{-- Submit Button --}}
          <div class="field-group -action">
            {!! Form::submit('Save and Continue', ['class' => 'button -default', 'name' => 'complete']) !!}
            {!! Form::submit('or Save as Draft', ['class' => 'button -link', 'name' => 'draft']) !!}
          </div>

        {!! Form::close() !!}

      </div>
    </div>

  </article>
@stop
