@extends('layouts.admin')

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
      <div class="col-md-4">
        <h2>Content</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
      </div>
      <div class="col-md-4">
        <h2>Something</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
     </div>
      <div class="col-md-4">
        <h2>Reports</h2>
        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
      </div>
    </div>

    @include('layouts.partials.admin-footer')
  </div>

@stop
