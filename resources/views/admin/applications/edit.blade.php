@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      @include('admin.layouts.partials.subnav-applications')

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1>{{ $user_info['first_name'] . ' ' . $user_info['last_name'] }}</h1>

        <div class="wrapper">
          <p>{{ strtolower($user_info['email']) }}</p>

          <hr>

        @if (!is_null($profile))
          <h2> Profile </h2>
          <div class="well well-lg">
          {!! Form::model($user, ['method' => 'PATCH', 'route' => ['profile.update', $id]]) !!}
            @include('profile/partials/_form_profile')
            {!! Form::submit('Update info', ['class' => 'btn btn-primary', 'name' => 'complete']) !!}
          {!! Form::close() !!}
         </div>
        @endif

        @if (!is_null($application))
          <h2>Application</h2>
          <div class="details well well-lg">
            {!! Form::model($application, ['method' => 'PATCH', 'route' => ['application.update', $id], 'class' => 'form--application']) !!}
              @include('application/partials/_form_application')
              {!! Form::submit('Update info', ['class' => 'btn btn-primary', 'name' => 'complete']) !!}
            {!! Form::close() !!}
          </div>
        @endif

        @if (!is_null($recommendations) && count($recommendations) > 0)
          <h2>Recommender Responses</h2>
          <div class="well well-lg">
             @foreach ($recommendations as $rec)
                  @include('admin/recommendations/edit', array('recommendation' => (object)$rec, 'label' => (object)$label))
              @endforeach
          </div>
        @endif

        </div>
      </div>

    </div>
  </div>
@stop
