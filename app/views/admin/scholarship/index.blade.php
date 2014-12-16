@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      {{-- @TODO: likely a better way to split this out in Blade! --}}
      @include('admin.layouts.partials.subnav-settings')

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Scholarships</h1>

        {{ '<a class="btn btn-default" href="' . URL::route('admin.scholarship.create', null) . '"><span class="glyphicon glyphicon-plus"></span> Create New Scholarship</a>' }}

        {{-- @TODO: get the real id! --}}
        {{ '<a class="btn btn-default" href="' . URL::route('admin.scholarship.edit', 1) . '"><span class="glyphicon glyphicon-pencil"></span> Edit Current Scholarship</a>' }}


        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Application Start</th>
                <th>Application End</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              @foreach($scholarships as $scholarship)
                <tr>
                  <td>{{ $scholarship->id }}</td>
                  <td>{{link_to('/admin/scholarship/' . $scholarship->id . '/edit' , $scholarship->title) }}</td>
                  <td>{{ output_full_date($scholarship->application_start) }}</td>
                  <td>{{ output_full_date($scholarship->application_end) }}</td>
                  <td> $ {{ $scholarship->amount_scholarship}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>

    </div>
  </div>
@stop
