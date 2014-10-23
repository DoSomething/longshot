@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      @include('admin.layouts.partials.subnav-applications')

       <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

        {{ Form::open(['route' => 'export.csv']) }}

          {{ Form::button('<i class="glyphicon glyphicon-download-alt"></i> Submitted Apps, no completed recs', array('type' => 'submit', 'class' => 'btn btn-default btn-lg')) }}

          <br/>

           {{ Form::button('<i class="glyphicon glyphicon-download-alt"></i> Submitted Apps, no requested recs', array('type' => 'submit', 'class' => 'btn btn-default btn-lg')) }}

          <br/>

          {{ Form::button('<i class="glyphicon glyphicon-download-alt"></i> Incomplete Apps', array('type' => 'submit', 'class' => 'btn btn-default btn-lg')) }}


          <br/>

          {{ Form::button('<i class="glyphicon glyphicon-download-alt"></i> Nominated, no app', array('type' => 'submit', 'class' => 'btn btn-default btn-lg')) }}


        {{ Form::close() }}

       </div>
      </div>
    </div>



@stop