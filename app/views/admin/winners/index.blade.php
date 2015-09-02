@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      @include('admin.layouts.partials.subnav-settings')


      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">All Winners</h1>

        <div class="dropdown">
          <a data-toggle="dropdown" href="#">Scholarship <span class='glyphicon glyphicon-chevron-down'/> </a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
              @foreach($scholarships as $scholarship)
                <li> {{ filter_winners_by($scholarship->id, $scholarship->title) }} </li>
              @endforeach
          </ul>
        </div>

        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name (edit winner info)</th>
                <th>College</th>
                <th>Winner ID</th>
              </tr>
              </thead>
            <tbody>
            @foreach ($winners as $winner)
            <tr>
              <td>{{ link_to_route('admin.winner.edit', $winner->first_name . ' ' . $winner->last_name, [$winner->id]) }}</td>
              <td>{{ $winner->college }}</td>
              <td>{{ $winner->id }}</td>
            </tr>
            @endforeach
            </tbody>

        </div>

    </div>
  </div>
@stop