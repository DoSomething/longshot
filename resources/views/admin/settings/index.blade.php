@extends('admin.layouts.master')

@section('main_content')
  {{-- @TODO: likely a better way to split this out in Blade! --}}
  @include('admin.layouts.partials.subnav-settings')

  <div class="container">
    <div class="row">

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Settings</h1>

          <p>Click below to create a new scholarship or edit the current one, or select another option from the sidebar.</p>

          {!! link_to_route('admin.scholarship.create', 'Create new scholarship »', null, ['class' => 'btn btn-default', 'role'=> 'button']) !!}

          {!! link_to_route('admin.scholarship.edit', 'Edit current scholarship »', $scholarship_id, ['class' => 'btn btn-default', 'role'=> 'button']) !!}
        </div>

    </div>
  </div>
@stop
