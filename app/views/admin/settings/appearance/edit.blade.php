@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      @include('admin.layouts.partials.subnav-settings')

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Appearance</h1>

        {{ Form::open(['route' => 'appearance.update', 'class' => 'col-md-8']) }}

          @include('admin.settings.partials._form_settings')

          <div>
            {{ Form::submit('Update Appearance Settings', ['class' => 'btn btn-default']) }}
          </div>

        {{ Form::close() }}

      </div>

    </div>
  </div>
@stop
