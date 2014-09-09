@extends('admin.layouts.master')

@section('main_content')

  <h1>Edit Static Page</h1>

  {{ Form::model($page, ['method' => 'PUT', 'route' => ['admin.page.update', $page->id], 'files' => true]) }}

    @include('admin/page/partials/_form_page')

    {{-- Submit Button --}}
    <div>
      {{ Form::submit('Update page', ['class' => 'btn btn-primary btn-large']) }}
    </div>

  {{ Form::close() }}

@stop
