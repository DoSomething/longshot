@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      @include('admin.layouts.partials.subnav-settings')
      {{ Form::open(['route' => 'emails.update']) }}


      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Emails!</h1>


      <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                  Applicant Emails
              </h4>
            </div>
              <div class="panel-body">
                  @foreach($applicant_emails as $key => $email)

                  @include('admin.settings.emails.partials._form_emails',  array('class' => 'applicant'))

                  @endforeach

              </div>
          </div>

    <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                  Recommender Emails
              </h4>
            </div>
              <div class="panel-body">

                  @foreach($recommender_emails as $key => $email)
                     @include('admin.settings.emails.partials._form_emails', array('class' => 'recommender'))
                  @endforeach

              </div>
          </div>

        {{ Form::close() }}
         <div>
            {{ Form::submit('Update Email Settings', ['class' => 'btn btn-default']) }}
          </div>
      </div>

    </div>
  </div>
@stop
