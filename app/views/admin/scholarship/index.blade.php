@extends('admin.layouts.master')

@section('styles')
  @parent
  <link rel="stylesheet" href="/dist/css/admin-dashboard.css"/>
@stop

@section('main_content')
  <div class="container-fluid">
    <div class="row">
{{$scholarships}}

      {{-- @TODO: likely a better way to split this out in Blade! --}}
      @include('admin.layouts.partials.subnav-settings')

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Scholarship List</h1>
        <h2 class="sub-header">All scholarships</h2>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th> Title </th>
                <th> Description </th>
                <th> Amount</th>
              </tr>
            </thead>
            <tbody>
              @foreach($scholarships as $scholarship)
                <tr>
                  <td>{{ $scholarship->id }}</td>
                  <td>{{link_to('/admin/scholarship/' . $scholarship->id . '/edit' , $scholarship->title) }}</td>
                  <td>{{ $scholarship->description }}</td>
                  <td> $ {{ $scholarship->amount_scholarship}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        {{ link_to_route('admin.scholarship.create', 'Create new scholarship »', null, array('class' => 'btn btn-default', 'role'=> 'button')) }}
        {{-- @TODO: get the real id! --}}
        {{ link_to_route('admin.scholarship.edit', 'Edit current scholarship »', 1, array('class' => 'btn btn-default', 'role'=> 'button')) }}
      </div>

    </div>
  </div>
@stop
