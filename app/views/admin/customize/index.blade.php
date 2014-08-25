@extends('layouts.admin')

@section('jumbotron')

<div class="jumbotron">
  <div class="container">
    <h1>Customize things</h1>


  </div>
</div>

@stop

@section('main_content')

  <div class="container">
    <div class="row">
      <div class="col-md-4">
        {{ link_to_route('admin.scholarship.create', 'Create new scholarship »', '', array('class' => 'btn btn-default', 'role'=> 'button')) }}
      </div>
      <div class="col-md-4">
        {{ link_to_route('admin.scholarship.update', 'Edit current scholarship »', '', array('class' => 'btn btn-default', 'role'=> 'button')) }}
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
