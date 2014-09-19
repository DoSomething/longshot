@extends('layouts.master')

@section('main_content')
  <section class="segment -compact">
    <div class="wrapper">

      <h1 class="heading -alpha text-primary-color">Edit Your Application</h1>

      {{ Form::model($user->application, ['method' => 'PATCH', 'route' => ['application.update', $user->id]]) }}

        @include('application/partials/_form_application')

        {{-- Submit Button --}}
        <div class="field-group">
          {{ Form::submit('Update Draft', ['class' => 'button -default', 'name' => 'draft']) }}
        </div>

      {{ Form::close() }}

    </div>
  </section>
@stop
