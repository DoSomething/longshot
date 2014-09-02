@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      {{-- @TODO: likely a better way to split this out in Blade! --}}
      @include('admin.layouts.partials.subnav-settings')

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Appearance</h1>

        {{ Form::model($appearance, ['route' => 'appearance.update', 'files' => 'true', 'class' => 'col-md-8']) }}

          @include('admin.appearance.partials._form_appearance')

          {{-- Submit Button --}}
          <div>
            {{ Form::submit('Update Appearance Settings', ['class' => 'btn btn-default']) }}
          </div>

        {{ Form::close() }}
      </div>

    </div>
  </div>
@stop
