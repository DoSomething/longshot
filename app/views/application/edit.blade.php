{{-- Application: Edit --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Edit Your Application</h1>

    <div class="segment -compact">
      <div class="wrapper">

        @if (!empty($vars->application_create_help_text))
          <p>{{ $vars->application_create_help_text }}</p>
        @endif

        {{ Form::model($user->application, ['method' => 'PATCH', 'route' => ['application.update', $user->id], 'class' => 'form--application']) }}

          @include('application/partials/_form_application')

        {{-- Submit Button --}}
        <div class="field-group -action">
          {{ Form::submit('Save as Draft', ['class' => 'button -link', 'name' => 'draft']) }}
          {{ Form::submit('Save and Continue', ['class' => 'button -default', 'name' => 'complete']) }}
        </div>

        {{ Form::close() }}

      </div>
    </div>

  </article>
@stop
