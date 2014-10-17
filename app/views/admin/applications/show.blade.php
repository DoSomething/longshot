@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      @include('admin.layouts.partials.subnav-applications')

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1> {{ $user['first_name'] . ' ' . $user['last_name'] }} </h1>
       {{ $user['email'] }}

        <h2>Profile Information</h2>
        <div class="well well-lg">
          <dl>
            @foreach ($profile as $key => $field)
                @if (!empty($field))
                 <dt><strong>{{ snakeCaseToTitleCase($key) }}</strong></dt>
                 <dd>{{ $field }}</dd>
                @endif
            @endforeach
            <dt><strong> Races </strong> </dt>
            @foreach($races as $race)
            <dd> {{ $race['race']}} <dd>
            @endforeach
          </dl>
        </div>

        @if (!is_null($application))
          <h2>Application Responses</h2>
          <div class="well well-lg">
            <dl>
                @foreach ($application as $key => $field)
                {{-- did the have a value in the field --}}
                @if (!empty($field))
                  {{-- does the field have a better title in the scholarship? --}}
                  @if (isset($scholarship[$key]))
                    <dt><strong>{{ snakeCaseToTitleCase($scholarship[$key]) }} </strong></dt>
                  @else
                    <dt><strong>{{ snakeCaseToTitleCase($key) }}</strong></dt>
                  @endif
                  <dd>{{ $field }}</dd>
                @endif
              @endforeach
            </dl>

          </div>
        @endif


        @if (!is_null($recomendations))
        <h2>Recommender Responses</h2>
        <div class="well well-lg">
          <dl>
            @foreach ($recomendations as $rec)
              @foreach ($rec as $key => $field)
                   @if (isset($scholarship[$key]))
                <dt><strong>{{ snakeCaseToTitleCase($scholarship[$key]) }} </strong></dt>
              @else
                <dt><strong>{{ snakeCaseToTitleCase($key) }}</strong></dt>
              @endif
              <dd>{{ $field }}</dd>
              @endforeach
            @endforeach
          </dl>
        </div>
        @endif

        @if ($show_rating)
          <div class='btn-group'>
          {{ Form::open(['route' => 'applications.rate']) }}
            {{ Form::hidden('app_id', $app_id->id)}}
            @foreach($possible_ratings as $rating)
              @if ($app_rating == $rating)
                {{ Form::submit($rating, ['class' => 'btn btn-info btn-md active', 'name' => 'rating']) }}

              @else
                {{ Form::submit($rating, ['class' => 'btn btn-info btn-md', 'name' => 'rating']) }}
              @endif
            @endforeach
           </div>

          {{ Form::close() }}
        @endif


        {{ Form::open(['route' => 'winner.store']) }}
        {{ Form::hidden('user_id', $id) }}
        {{ Form::submit('make this a winner', ['class' => 'btn btn-primary btn-lg', 'name' => 'winner']) }}
        {{ Form::close() }}

      </div>



    </div>
  </div>
@stop
