@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      @include('admin.layouts.partials.subnav-applications')

       <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <button type="button" class="btn btn-default btn-lg">
            <span class = 'glyphicon glyphicon-download-alt'></span>
            Submitted Apps, no completed recs
          </button>

          <button type="button" class="btn btn-default btn-lg">
            <span class = 'glyphicon glyphicon-download-alt'></span>
            Submitted Apps, no requested recs
          </button>

          <button type="button" class="btn btn-default btn-lg">
            <span class = 'glyphicon glyphicon-download-alt'></span>
            Incomplete Apps
          </button>

          <button type="button" class="btn btn-default btn-lg">
            <span class = 'glyphicon glyphicon-download-alt'></span>
            Nominated, no app
          </button>

       </div>
      </div>
    </div>



@stop