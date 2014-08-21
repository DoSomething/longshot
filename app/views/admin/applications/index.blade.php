@extends('layouts.admin')

@section('styles')
  @parent
  <link rel="stylesheet" href="/dist/css/admin-dashboard.css"/>
@show

@section('main_content')

  <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Overview</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Export</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item</a></li>
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Applications</h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="http://placekitten.com/g/200/200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Data</h4>
              <span class="text-muted">Chart data here</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="http://placekitten.com/g/200/200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Data</h4>
              <span class="text-muted">Chart data here</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="http://placekitten.com/g/200/200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Data</h4>
              <span class="text-muted">Chart data here</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="http://placekitten.com/g/200/200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Data</h4>
              <span class="text-muted">Chart data here</span>
            </div>
          </div>

          <h2 class="sub-header">All Applications</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Recommendations</th>
                  <th>Score</th>
                </tr>
              </thead>
              <tbody>
                @foreach($applicants as $applicant)
                  <tr>
                    <td>{{ $applicant->id }}</td>
                    <td>{{ $applicant->first_name . ' ' . $applicant->last_name }}</td>
                    <td>completed</td>
                    <td>2</td>
                    <td>&#9733; &#9733; &#9733;</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

@stop
