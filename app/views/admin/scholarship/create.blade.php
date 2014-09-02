@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      {{-- @TODO: likely a better way to split this out in Blade! --}}
      @include('admin.layouts.partials.subnav-settings')

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Create a new Scholarship</h1>

        {{ Form::open(['route' => 'admin.scholarship.store', 'class' => 'col-md-8']) }}

          @include('admin.scholarship.partials._form_scholarship')

          {{-- Submit Button --}}
          <div>
            {{ Form::submit('Save Scholarship', ['class' => 'btn btn-default']) }}
          </div>

        {{ Form::close() }}
      </div>

    </div>
  </div>
@stop
