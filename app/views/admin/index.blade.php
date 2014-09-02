@extends('admin.layouts.master')

@section('jumbotron')

<div class="jumbotron">
  <div class="container">
    <h1>Welcome, {{ $user->first_name }}!</h1>

    <p>There are a total of <strong>{{ $userCount }}</strong> users in the system.</p>
    <p>{{ link_to_route('applications', 'View all Applications', null, ['class' => 'btn btn-primary btn-lg']) }}</p>
  </div>
</div>

@stop

@section('main_content')

  <div class="container">
    <div class="row">

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

    @include('admin.layouts.partials.footer')
  </div>

@stop
