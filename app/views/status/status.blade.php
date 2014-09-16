@extends('layouts.master')

@section('main_content')
  <section class="segment">
    <h1 class="heading -alpha">Application Status</h1>

    <h2>{{ Auth::check() ? 'Welcome, ' . Auth::user()->first_name : 'Welcome to the Scholarship App!' }}</h2>

  {{-- TODO: fix this up a bit--}}
  @if (isset($profile))
  [X] Profile
  @else
  [ ] Profile
  @endif

  @if (isset($application))
  [X] Application
  @else
  [ ] Application
  @endif


  @if (isset($recommendations))
  <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th> Name </th>
                <th> Email </th>
                <th> Status </th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($recommendations as $rec)
                <tr>
                  <td>{{ $rec->first_name . ' ' . $rec->last_name}}</td>
                  <td>{{ $rec->email }}</td>
                  <td> {{$rec->complete}}</td>
                  <td> {{link_to_route('resend', 'Resend Request', array('id' => $rec->id))}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
    @endif
  </section>
@stop