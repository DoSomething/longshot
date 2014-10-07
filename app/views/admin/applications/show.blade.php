@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      @include('admin.layouts.partials.subnav-applications')

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">


        <h2>Profile Information</h2>
        <div class="well well-lg">
          <dl>
            @foreach ($profile as $key => $field)
                @if (!empty($field))
                 <dt><strong>{{ snakeCaseToTitleCase($key) }}</strong></dt>
                 <dd>{{ $field }}</dd>
                @endif
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

        <div class='btn-group'>
        {{ Form::open(['route' => 'applications.rate']) }}
          {{ Form::hidden('app_id', $app_id->id)}}
         {{ Form::submit('Yes', ['class' => 'btn btn-primary btn-md', 'name' => 'rating']) }}
         {{ Form::submit('No', ['class' => 'btn btn-primary btn-md', 'name' => 'rating']) }}
         {{ Form::submit('Maybe', ['class' => 'btn btn-primary btn-md', 'name' => 'rating']) }}
         </div>

        {{ Form::close() }}

      </div>



    </div>
  </div>
@stop
