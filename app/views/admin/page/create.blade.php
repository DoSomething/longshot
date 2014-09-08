@extends('admin.layouts.master')

@section('main_content')
  <section class="segment">
    <h1 class="heading -alpha">Complete A Static Page</h1>

    {{ Form::open(['route' => 'admin.page.store', 'files' => true]) }}

    @include('admin/page/partials/_form_page')

    {{-- Submit Button --}}
    <div>
      {{ Form::submit('Save page', ['class' => 'btn btn-primary btn-large']) }}
    </div>

    {{ Form::close() }}
  </section>
@stop
