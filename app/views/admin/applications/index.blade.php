@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">

      {{-- @TODO: likely a better way to split this out in Blade! --}}
      @include('admin.layouts.partials.subnav-applications')

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">All Applications</h1>

        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th> {{ sort_applicants_by('last_name', 'Name') }}</th>
                <th> {{ sort_applicants_by('status', 'Status') }} </th>
                <th>Recommendations</th>
                <th>Score</th>
              </tr>
            </thead>
            <tbody>
              @foreach($applicants as $applicant)
                <tr>
                  <td>{{ $applicant->id }}</td>
                  <td>{{link_to('/admin/applications/' . $applicant->id , $applicant->first_name . ' ' . $applicant->last_name) }}</td>
                  <td>completed</td>
                  <td>2</td>
                  <td>&#9733; &#9733; &#9733;</td>
                </tr>
              @endforeach
            </tbody>
          </table>
           {{ $applicants->links() }}
        </div>
      </div>

    </div>
  </div>
@stop
