@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      {{-- @TODO: likely a better way to split this out in Blade! --}}
      @include('admin.layouts.partials.subnav-settings')

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Edit Scholarship</h1>
        <p>For more information on the settings seen here, check out the <a href="https://github.com/DoSomething/longshot/wiki/Scholarship-Settings">wiki page.</a></p>
        {!! Form::model($scholarship, ['method' => 'PATCH', 'route' => ['admin.scholarship.update', $scholarship->id]]) !!}

          @include('admin.scholarship.partials._form_scholarship')

          {{-- Submit Button --}}
          <div>
            {!! Form::submit('Update scholarship') !!}
          </div>

        {!! Form::close() !!}
      </div>

    </div>
  </div>
@stop
