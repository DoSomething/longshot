@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      @include('admin.layouts.partials.subnav-applications')

       <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

        {!! Form::open(['route' => 'export.csv']) !!}

          {!! Form::button('<i class="glyphicon glyphicon-download-alt"></i> Submitted Apps, no completed recs', array('type' => 'submit', 'name' => 'submitted_blank_rec', 'class' => 'btn btn-default btn-lg')) !!}

          <br/>

           {!! Form::button('<i class="glyphicon glyphicon-download-alt"></i> Submitted Apps, no requested recs', array('type' => 'submit', 'name'=> 'submitted_no_rec', 'class' => 'btn btn-default btn-lg')) !!}

          <br/>

          {!! Form::button('<i class="glyphicon glyphicon-download-alt"></i> Incomplete Apps', array('type' => 'submit','name' => 'incomplete_apps', 'class' => 'btn btn-default btn-lg')) !!}


          <br/>

          {!! Form::button('<i class="glyphicon glyphicon-download-alt"></i> Nominated, no app', array('type' => 'submit', 'name' => 'nominated_no_app', 'class' => 'btn btn-default btn-lg')) !!}

          <br/>

          {!! Form::button('<i class="glyphicon glyphicon-download-alt"></i> Completed apps', array('type' => 'submit', 'name' => 'completed_apps', 'class' => 'btn btn-default btn-lg')) !!}

          <br/>

           {!! Form::button('<i class="glyphicon glyphicon-download-alt"></i> Requested Recs, not complete', array('type' => 'submit', 'name' => 'rec_requested_not_finished', 'class' => 'btn btn-default btn-lg')) !!}

          <br/>

           {!! Form::button('<i class="glyphicon glyphicon-download-alt"></i> Nominators', array('type' => 'submit', 'name' => 'nominators', 'class' => 'btn btn-default btn-lg')) !!}

          <br/>

           {!! Form::button('<i class="glyphicon glyphicon-download-alt"></i> Nominees', array('type' => 'submit', 'name' => 'nominees', 'class' => 'btn btn-default btn-lg')) !!}

          <br/>

           {!! Form::button('<i class="glyphicon glyphicon-download-alt"></i> Recommenders', array('type' => 'submit', 'name' => 'recommenders', 'class' => 'btn btn-default btn-lg')) !!}

          <br/>

           {!! Form::button('<i class="glyphicon glyphicon-download-alt"></i> Completed apps by first name and email', array('type' => 'submit', 'name' => 'completed_apps_by_first_and_email', 'class' => 'btn btn-default btn-lg')) !!}

          <br/>

           {!! Form::button('<i class="glyphicon glyphicon-download-alt"></i> Incomplete apps by first name and email', array('type' => 'submit', 'name' => 'incomplete_apps_by_first_and_email', 'class' => 'btn btn-default btn-lg')) !!}

          <br/>

           {!! Form::button('<i class="glyphicon glyphicon-download-alt"></i> Applications marked yes', array('type' => 'submit', 'name' => 'yes_applicants', 'class' => 'btn btn-default btn-lg')) !!}
        {!! Form::close() !!}

       </div>
      </div>
    </div>



@stop
