<?php //dd($recomendations); ?>
@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      @include('admin.layouts.partials.subnav-applications')

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1>{{ $user['first_name'] . ' ' . $user['last_name'] }}</h1>

        <div class="wrapper">
          <p>{{ strtolower($user['email']) }}</p>
          {{-- link_to_route('admin.application.edit', ' Edit User', array($id), ['class' => 'glyphicon glyphicon-pencil']) --}}
          {{ '<a class="btn btn-default btn-edit" href="' . URL::route('admin.application.edit', array('id' => $id)) . '"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>' }}

          <hr>

          <h2>Profile Information</h2>
          <div class="details well well-lg">
            @foreach ($profile as $key => $field)
                @if (!empty($field))
                  <div>
                    <p><strong>{{ snakeCaseToTitleCase($key) }}:</strong> {{ $field }}</p>
                  </div>
                @endif
            @endforeach

            <div>
              <p><strong>Races:</strong></p>
              <ul>
                @foreach($races as $race)
                <li> {{ $race['race']}} </li>
                @endforeach
              </ul>
            </div>
          </div>

          @if (!is_null($application))
            <h2>Application Responses</h2>
            <div class="details well well-lg">
              @foreach ($application as $key => $field)
                <div>
                  {{-- Does it have a value in the field? --}}
                  @if (!empty($field))
                    {{-- Does the field have a better title in the scholarship? --}}
                    @if (isset($scholarship[$key]))
                      <p><strong>{{ snakeCaseToTitleCase($scholarship[$key]) }}</strong></p>
                    @else
                      <p><strong>{{ snakeCaseToTitleCase($key) }}</strong></p>
                    @endif
                      <p>{{ $field }}</p>
                  @endif
                </div>
              @endforeach
            </div>
          @endif


          @if (!is_null($recomendations) && count($recomendations) > 0)
            <h2>Recommender Responses</h2>
            <div class="details well well-lg">
              @foreach ($recomendations as $rec)
                @foreach ($rec as $key => $field)
                  <div>
                    @if (isset($scholarship[$key]))
                      <p><strong>{{ snakeCaseToTitleCase($scholarship[$key]) }}</strong></p>
                    @else
                      <p><strong>{{ snakeCaseToTitleCase($key) }}</strong></p>
                    @endif
                      <p>{{ $field }}</p>
                  </div>
                @endforeach
              @endforeach
            </div>
          @endif


          @if ($show_rating)
            <hr>

            <h2>Review</h2>

            <div class="segment">
              {{ Form::open(['route' => 'applications.rate']) }}
                {{ Form::hidden('app_id', $app_id->id)}}
                <p><strong>Application rating:</strong></p>
                <div class="btn-group" role="group">
                  @foreach($possible_ratings as $rating)
                    @if ($app_rating == $rating)
                      {{ Form::submit(ucfirst($rating), ['class' => 'btn btn-default btn-md active', 'name' => 'rating']) }}
                    @else
                      {{ Form::submit(ucfirst($rating), ['class' => 'btn btn-default btn-md', 'name' => 'rating']) }}
                    @endif
                  @endforeach
                </div>
              {{ Form::close() }}
            </div>

            @if ($app_rating && $app_rating == 'yes')
              <div class="segment">
                {{ Form::open(['route' => 'admin.winner.store']) }}
                  <p><strong>Is {{ $user['first_name'] }} a scholarship winner?</strong></p>
                  {{ Form::hidden('user_id', $id) }}
                  {{ Form::submit('Award Scholarship!', ['class' => 'btn btn-primary btn-md', 'name' => 'winner']) }}
                {{ Form::close() }}
              </div>
            @endif
          @endif

        </div>
      </div>

    </div>
  </div>
@stop
