@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      @include('admin.layouts.partials.subnav-applications')

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1>{{ $user['first_name'] . ' ' . $user['last_name'] }}</h1>

        <div class="wrapper">
          <p>{{ strtolower($user['email']) }}</p>
          {!! '<a class="btn btn-default btn-edit" href="' . URL::route('admin.application.edit', array('id' => $id)) . '"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>' !!}

          <hr>

          @if (isset($profile))
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
          @endif

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
                    @if ($key == 'upload')
                     @if (!is_null($uploads))
                        @foreach ($uploads as $upload)
                          <div class="image-holder">
                            <img src="/storage/app/uploads/{{$id}}/{{$upload}}" alt="uploaded image">
                          </div>
                          <br>
                        @endforeach
                      @endif
                    @else
                      <p>{{ $field }}</p>
                    @endif
                  @endif
                </div>
              @endforeach
            </div>
          @endif

          @if (!is_null($recommendations) && count($recommendations) > 0)
            <h2>Recommender Responses</h2>
            <div class="details well well-lg">
              @foreach ($recommendations as $rec)
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
                {!! Form::open(['route' => 'admin.resend']) !!}
                {!! Form::hidden('rec_id', $rec['id'])!!}
                {!! Form::hidden('applicant_id', $id)!!}
                {!! Form::submit(('Resend Email To Recommender'), ['class' => 'btn btn-default btn-md']) !!}
                {!! Form::close() !!}
              @endforeach
            </div>
          @endif


          @if ($show_rating)
            <hr>

            <h2>Review</h2>

            <div class="segment">
              {!! Form::open(['route' => 'applications.rate']) !!}
                {!! Form::hidden('app_id', $app_id->id)!!}
                <p><strong>Application rating:</strong></p>
                <div class="btn-group" role="group">
                  @foreach($possible_ratings as $rating)
                    @if ($app_rating == $rating)
                      {!! Form::submit(ucfirst($rating), ['class' => 'btn btn-default btn-md active', 'name' => 'rating']) !!}
                    @else
                      {!! Form::submit(ucfirst($rating), ['class' => 'btn btn-default btn-md', 'name' => 'rating']) !!}
                    @endif
                  @endforeach
                </div>
              {!! Form::close() !!}
            </div>

            @if ($app_rating && $app_rating == 'yes')
              <div class="segment">
                @if ($is_winner)
                  {{ Form::open(['route' => ['admin.winner.destroy' ,$id], 'method' => 'delete']) }}
                    <p><strong>Revoke scholarship from {{ $user['first_name'] }}?</strong></p>
                    <p><small>Note: this will also delete any information saved for {{ $user['first_name'] }}'s scholarship winner profile.</small></p>
                    {{ Form::hidden('user_id', $id) }}
                    {{ Form::hidden('scholarship_id', $application['scholarship_id']) }}
                    {{ Form::submit('Revoke Scholarship!', ['class' => 'btn btn-danger btn-md', 'name' => 'winner']) }}
                  {{ Form::close() }}
                @else
                  {{ Form::open(['route' => 'admin.winner.store']) }}
                    <p><strong>Award scholarship to {{ $user['first_name'] }}?</strong></p>
                    {{ Form::hidden('user_id', $id) }}
                    {{ Form::submit('Award Scholarship!', ['class' => 'btn btn-success btn-md', 'name' => 'winner']) }}
                  {{ Form::close() }}
                @endif
              </div>
            @endif
            @elseif (!is_null($application) && $is_submitted)
              {!! Form::open(['route' => 'applications.complete']) !!}
              {!! Form::hidden('app_id', $app_id->id)!!}
              {!! Form::submit(('Mark as complete'), ['class' => 'btn btn-default btn-md']) !!}
              {!! Form::close() !!}
          @endif


        </div>
      </div>

    </div>
  </div>
@stop
