@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Create A Static Page</h1>

        {!! Form::open(['route' => 'admin.page.store', 'files' => 'true', 'class' => 'col-md-8']) !!}

        @include('admin/page/partials/_form_page')

        {{-- Submit Button --}}
        <div class="col-sm-3 col-md-2 sidebar">
          {!! Form::submit('Save page', ['class' => 'btn btn-primary btn-large']) !!}
          <a class="btn btn-default" href="{{ URL::route('admin.page.index') }}"><span class="glyphicon glyphicon-arrow-left"></span> Back to page list</a>
        </div>

        {!! Form::close() !!}

      </div>

    </div>
  </div>
@stop
