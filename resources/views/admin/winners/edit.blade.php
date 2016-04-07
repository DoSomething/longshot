@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      @include('admin.layouts.partials.subnav-settings')


      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">
        {{ $winner->first_name . ' ' . $winner->last_name }}
        </h1>

        {{ Form::model($winner, ['method' => 'PATCH', 'route' => ['admin.winner.update', $winner->id], 'files' => TRUE, 'class' => 'col-md-8']) }}

          <div class="form-group">
            {{ Form::label('photo', 'Photo: ') }}

            @if (!empty($winner->photo))
              <div class="image-holder">
                <img src="{{ $winner->photo }}" alt="uploaded image">
              </div>
            @endif

            {{ Form::file('photo') }}
          </div>

          <div class="form-group">
            {{ Form::label('description', 'Bio: ') }}
            {{ Form::textarea('description', $winner->description, ['class' => 'form-control', 'placeholder' => 'enter biography for winner']) }}
          </div>

          <div class="form-group">
            {{ Form::label('college', 'College: ') }}
            {{ Form::text('college', $winner->college, ['class' => 'form-control', 'placeholder' => 'enter college name']) }}
          </div>

          {{-- Submit Button --}}
          <div>
            {{ Form::submit('Update winner', ['class' => 'btn btn-default']) }}
          </div>

        {{ Form::close() }}
      </div>

    </div>
  </div>
@stop
