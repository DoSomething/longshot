{{-- Status --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Application Status</h1>

    <div class="segment">
      <div class="wrapper">
        <h2 class="heading -gamma">Status: <em> {{ $status }} </em></h2>
        @if(! empty($help_text))
          <p>{{ $help_text }}</p>
        @endif

        <p>Thank you for submitting your application. Come back here to check on your application status. Your application will be complete once we receive the required recommendation(s).</p>
      </div>
    </div>

    <section class="segment segment--checklist">
      <div class="wrapper">
        <h1 class="heading -gamma">What's up</h1>

        <ul class="media-list media-list--status">
          <li class="{{ $prof_complete ? 'complete' : '-incomplete' }}">
            <span class="icon icon-status" data-icon="&#x2713"></span>Basic Information
            {{ isset($profile) ? '<a class="__link" href="' . URL::route('profile.edit', Auth::user()->id) . '">Edit<span class="icon icon-edit"></span></a>' : '<a class="" href="' . URL::route('profile.create', null) . '">Start<span class="icon icon-start"></span></a>' }}
          </li>
          <li class="{{ $app_complete ? 'complete' : '-incomplete' }}">
            <span class="icon icon-status" data-icon="&#x2713"></span>Application
            @if (isset($application) && !($application->complete))
              {{ '<a class="__link" href="' . URL::route('application.edit', Auth::user()->id) . '">Edit<span class="icon icon-edit"></span></a>' }}
            @elseif (is_null($application) && !is_null($profile))
              {{ '<a class="__link" href="' . URL::route('application.create', Auth::user()->id) . '">Start<span class="icon icon-start"></span></a>' }}
            @endif
          </li>
        </ul>

        @if (isset($submit))
          {{ $submit }}
        @endif


        @if (!empty($recommendations))

          <ul class="media-list media-list--status">
            @foreach($recommendations as $index => $rec)
              @if($rec['complete'] !== 'All set!')
              <li class="-incomplete">
              @else
              <li class="complete">
              @endif
                <span class="icon icon-status" data-icon="&#x2713"></span>Recommendation
                <ul>
                  <li>Request Status: <em>{{ $rec['complete'] }}</em></li>
                  <li>Submitted to <strong>{{ $rec['first_name'] . ' ' . $rec['last_name']}}</strong></li>
                  <li>Email sent to <strong>{{ $rec['email'] }}</strong></li>
                </ul>

                @if ($rec['complete'] !== 'All set!')
                  {{ '<a class="__link" href="' . URL::route('resend', array('id' => $rec['id'])) . '">Resend<span class="icon icon-send"></span></a>' }}
                @endif
              </li>
            @endforeach
          </ul>

          @if (isset($add_rec_link))
            {{ $add_rec_link }}
          @endif

        @elseif (!is_null($application))
          <ul class="media-list media-list--status">
            <li class="-incomplete">
              <span class="icon icon-status" data-icon="&#x2713"></span>Recommendation
            </li>
          </ul>
          {{ link_to_route('recommendation.create', 'Get Recommendations', null, ['class' => 'button -small']); }}
        @endif

      </div>
    </section>

    <section class="segment segment--timeline">
      <div class="wrapper">

        <h2 class="heading -gamma">Key Dates</h1>

        {{ $timeline }}

      </div>
    </section>


    <footer>
      <div class="wrapper">
        <p>Need help? <a href="mailto:{{Config::get('mail.from.address')}}">Contact Us</a></p>
      </div>
    </footer>

  </article>
@stop
