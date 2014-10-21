@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      @include('admin.layouts.partials.subnav-applications')


      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">All Applications</h1>
        {{ $applicants->links() }}


        {{ Form::open(['route' => 'search', 'class' => 'navbar-form navbar-right']) }}
        <div class="form-group">
          {{ Form::text('search',  NULL, ['placeholder' => 'last name']) }}
        </div>
        <button type="submit" class="btn btn-default glyphicon glyphicon-search"> Submit</button>
        {{ Form::close() }}

        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th> {{ sort_applicants_by('last_name', 'Name') }}</th>
                <th>
                <div class="dropdown">
                    <a data-toggle="dropdown" href="#">Gender <span class='glyphicon glyphicon-chevron-down'/> </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                       <li> {{ filter_applicants_by('m', 'Male') }} </li>
                      <li> {{ filter_applicants_by('f', 'Female') }} </li>
                    </ul>
                  </div>
                </th>
                <th> State </th>
                <th> {{ sort_applicants_by('gpa', 'GPA') }} </th>
                <th>
                  <div class="dropdown">
                    <a data-toggle="dropdown" href="#">Status <span class='glyphicon glyphicon-chevron-down'/> </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                       <li> {{ filter_applicants_by('completed', 'Completed') }} </li>
                      <li> {{ filter_applicants_by('submitted', 'Submitted') }} </li>
                      <li> {{ filter_applicants_by('incomplete', 'Incomplete') }} </li>
                    </ul>
                  </div>
                </th>
                <th>
                  <div class="dropdown">
                    <a data-toggle="dropdown" href="#">Score <span class='glyphicon glyphicon-chevron-down'/> </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                       <li> {{ filter_applicants_by('yes', 'Yes') }} </li>
                      <li> {{ filter_applicants_by('no', 'No') }} </li>
                      <li> {{ filter_applicants_by('maybe', 'Maybe') }} </li>
                    </ul>
                  </div>
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($applicants as $applicant)
                <tr>
                  <td>{{ $applicant->id  }}</td>
                  <td>{{ link_to('/admin/applications/' . $applicant->id , $applicant->first_name . ' ' . $applicant->last_name) }}</td>

                  <td> {{{ $applicant->gender or '' }}} </td>
                  <td> {{{ $applicant->state or '' }}} </td>
                  <td> {{{ $applicant->gpa or '' }}} </td>
                  <td>
                  @if ($applicant->completed && $applicant->submitted)
                    Completed
                  @elseif ($applicant->submitted)
                    Submitted
                  @else
                    Incomplete
                  @endif
                  </td>
                  <td>
                    {{{$applicant->rating or ''}}}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          {{$applicants->links()}}
        </div>
      </div>
    </div>
  </div>
@stop
