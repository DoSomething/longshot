@extends('layouts.master')

@section('main_content')

  <h1>Edit Profile</h1>

  {{ Form::model($user->recomendation, ['method' => 'PATCH', 'route' => ['recomendation.update', $user->id]]) }}

    {{-- This will be seen by the recomender --}}

    {{-- Submit Button --}}
    <div>
      {{ Form::submit('Update Profile') }}
    </div>

  {{ Form::close() }}

@stop
