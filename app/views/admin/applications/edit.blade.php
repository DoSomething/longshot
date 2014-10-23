@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      @include('admin.layouts.partials.subnav-applications')

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1> {{ $user_info['first_name'] . ' ' . $user_info['last_name'] }} </h1>
       {{ $user_info['email'] }}


       <div class="well well-lg">
       <h3> Profile </h3>

        {{ Form::model($user, ['method' => 'PATCH', 'route' => ['profile.update', $id]]) }}
          @include('profile/partials/_form_profile')
        {{ Form::submit('Save', ['class' => 'button -default -beta', 'name' => 'complete']) }}
        {{ Form::close() }}

       </div>

       <div class="well well-lg">
        <h3> Application </h3>
         {{ Form::model($application, ['method' => 'PATCH', 'route' => ['application.update', $id], 'class' => 'form--application']) }}
         @include('application/partials/_form_application')

          {{ Form::submit('Save', ['class' => 'button -default -beta', 'name' => 'complete']) }}


          {{ Form::close() }}
        </div>

      </div>



    </div>
  </div>
@stop
