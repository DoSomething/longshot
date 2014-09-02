@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      {{-- @TODO: likely a better way to split this out in Blade! --}}
      @include('admin.layouts.partials.subnav-settings')

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Specific Scholarship</h1>
        <p><em>More Coming Soon!</em></p>
      </div>

    </div>
  </div>
@stop
