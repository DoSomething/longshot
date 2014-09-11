@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      {{-- @TODO: likely a better way to split this out in Blade! --}}
      @include('admin.layouts.partials.subnav-applications')

      {{-- @TODO: Maybe use 3 curly braces to escape user entered data? --}}
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">{{ "{$applicant->first_name} {$applicant->last_name}" }}'s Application</h1>

        {{-- @TODO: Refactor once validation is added to the application form fields. --}}
        <h2>Profile Information</h2>
        <div class="well well-lg">
          <p><strong>Email:</strong> <a href="mailto:{{ $applicant->email }}">{{ $applicant->email }}</a></p>

          <p><strong>Birtdate:</strong> {{ $applicant->profile->birthdate or '<em>Empty</em>' }}</p>

          <p><strong>Street Address:</strong> {{ $applicant->profile->address_street or '<em>Empty</em>' }}</p>

          @if(isset($applicant->profile->address_premise))
          <p><strong>Apt, Suite, Floor, Other:</strong> {{ $applicant->profile->address_premise }}</p>
          @endif

          <p><strong>City, State, Zip:</strong> {{ $applicant->profile->city or '<em>Empty</em>' }}, {{ $applicant->profile->state or '<em>Empty</em>' }} {{ $applicant->profile->zip or '<em>Empty</em>' }}</p>

          <p><strong>Phone Number:</strong> {{ $applicant->profile->phone or '<em>Empty</em>' }}</p>

          <p><strong>Gender:</strong> {{ $applicant->profile->gender or '<em>Empty</em>' }}</p>

          <p><strong>Race:</strong> {{ $applicant->profile->race or '<em>Empty</em>' }}</p>

          <p><strong>School:</strong> {{ $applicant->profile->school or '<em>Empty</em>' }}</p>

          <p><strong>Grade:</strong> {{ $applicant->profile->grade or '<em>Empty</em>' }}</p>
        </div>


        <h2>Application Responses</h2>
        <div class="well well-lg">

          <p><strong>GPA:</strong> {{ $applicant->application->gpa or '<em>Empty</em>' }}</p>

          <p><strong>Test Type:</strong> {{ $applicant->application->test_type or '<em>Empty</em>' }}</p>

          <p><strong>Test Score:</strong> {{ $applicant->application->test_score or '<em>Empty</em>' }}</p>

          <div>
            <strong>Accomplishments:</strong><br>
            {{ $applicant->application->accomplishments or '<em>Empty</em>' }}
          </div>

          <div>
            <strong>Activities:</strong><br>
            {{ $applicant->application->activities or '<em>Empty</em>' }}
          </div>

          <div>
            <strong>Essay #1:</strong><br>
            {{ $applicant->application->essay1 or '<em>Empty</em>' }}
          </div>

          <div>
            <strong>Essay #2:</strong><br>
            {{ $applicant->application->essay2 or '<em>Empty</em>' }}
          </div>

        </div>

      </div>

    </div>
  </div>
@stop
