@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      @include('admin.layouts.partials.subnav-settings')


      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">
        {{ $winner->user->first_name . ' ' . $winner->user->last_name }}
        </h1>

        {{ Form::model($winner, ['method' => 'PATCH', 'route' => ['admin.winner.update', $winner->id]]) }}

        <div class="form-group">
          {{ Form::label('photo', 'Photo: ') }}
          {{  Form::file('photo') }}
        </div>

        <div class="form-group">
          {{ Form::label('description', 'Bio: ') }}
          {{ Form::textarea('description') }}
        </div>

        <div class="form-group">
          {{ Form::label('college', 'College: ') }}
          {{ Form::text('college') }}
        </div>

          {{-- Submit Button --}}
          <div>
            {{ Form::submit('Update winner') }}
          </div>

        {{ Form::close() }}
      </div>

    </div>
  </div>
@stop
