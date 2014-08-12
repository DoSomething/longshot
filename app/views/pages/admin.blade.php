@extends('layouts.master')

@section('main_content')
  <h1>Admin</h1>

  <h2>Welcome, {{ $user->first_name }}!</h2>

  <p>Main Administrative information and settings go here!</p>

@stop
