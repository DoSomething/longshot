{{-- Application: Edit --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Edit Your Application</h1>

    <div class="segment -compact">
      <div class="wrapper">

        {{ Form::model($user->application, ['method' => 'PATCH', 'route' => ['application.update', $user->id]]) }}

          @include('application/partials/_form_application')

          {{-- Submit Button --}}
          <div class="field-group">
            {{ Form::submit('Update Draft', ['class' => 'button -default', 'name' => 'draft']) }}
          </div>

        {{ Form::close() }}

      </div>
    </div>

  </article>
@stop
