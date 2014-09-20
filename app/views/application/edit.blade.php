{{-- Application: Edit --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Edit Your Application</h1>

    <div class="segment -compact">
      <div class="wrapper">

      {{ $help_text }}
      {{ Form::model($user->application, ['method' => 'PATCH', 'route' => ['application.update', $user->id]]) }}

          @include('application/partials/_form_application')

        {{-- Submit Button --}}
        <div class="field-group">
            {{ Form::submit('Save as Draft', ['class' => 'button -default', 'name' => 'draft']) }}
           {{ Form::submit('Save and Continue', ['class' => 'button -default', 'name' => 'complete']) }}
        </div>

        {{ Form::close() }}

      </div>
    </div>

  </article>
@stop
