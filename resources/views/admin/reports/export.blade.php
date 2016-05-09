@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      @include('admin.layouts.partials.subnav-applications')

         <div class="col-xs-3 col-xs-offset-2 main">

        {!! Form::open(['route' => 'email.group']) !!}
          @foreach($export_options as $option => $text)
            {!! Form::button('<i class="glyphicon glyphicon-send"></i> Send Email', array('type' => 'submit', 'name' =>  $option, 'class' => 'btn btn-default btn-lg')) !!}
          @endforeach

          <br/>

        {!! Form::close() !!}

        </div>

       <div class="col-xs-3 main">

        {!! Form::open(['route' => 'export.csv']) !!}
          @foreach($export_options as $option => $text)
            {!! Form::button('<i class="glyphicon glyphicon-download-alt"></i>'.$text, array('type' => 'submit', 'name' => $option, 'class' => 'btn btn-default btn-lg')) !!}
          @endforeach

          <br/>

        {!! Form::close() !!}

       </div>
      </div>
    </div>



@stop
