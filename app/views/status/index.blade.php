{{-- Status --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Application Status</h1>

    <div>
      <h2 class="heading -gamma">Status: <em>In Progress</em></h2>
      <p>Some message regarding what's going on w/ your application.</p>
    </div>

    <section class="segment segment--checklist">
      <h1 class="heading -delta">What's up</h1>

      <ul class="media-list media-list--status">
        <li class="{{ isset($profile) ? 'complete' : '-incomplete' }}">
          <span class="icon" data-icon="&#x2713"></span>Basic Information
          {{ isset($profile) ? link_to_route('profile.edit', 'edit', Auth::user()->id) : link_to_route('profile.create', 'start') }}
        </li>
        <li class="{{ isset($application) ? 'complete' : '-incomplete' }}">
          <span class="icon" data-icon="&#x2713"></span>Application
          {{ isset($application) ? link_to_route('application.edit', 'edit', Auth::user()->id) : link_to_route('application.create', 'start') }}
        </li>
      </ul>

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
        </div>
      @endif
    </section>

    <section class="segment">
      <h1 class="heading -delta">Important Dates</h1>
      <p><em>Dates to come...</em></p>
    </section>

    <div class="contact">
      <p>Need help? <a href="mailto:gthomas@tmiagency.org">Contact Us</a></p>
    </div>

  </article>
@stop
