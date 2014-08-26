@extends('admin.layouts.master')

@section('styles')
  @parent
  <link rel="stylesheet" href="/dist/css/admin-dashboard.css"/>
@stop

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      {{-- @TODO: likely a better way to split this out in Blade! --}}
      @include('admin.layouts.partials.subnav-settings')

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Scholarship List</h1>
        <p><em>More Coming Soon!</em></p>
        {{ link_to_route('admin.scholarship.create', 'Create new scholarship »', null, array('class' => 'btn btn-default', 'role'=> 'button')) }}

        {{ link_to_route('admin.scholarship.edit', 'Edit current scholarship »', '@TODO:NeedID!', array('class' => 'btn btn-default', 'role'=> 'button')) }}
      </div>

    </div>
  </div>
@stop
