@extends('admin.layouts.master')

@section('jumbotron')

<div class="jumbotron">
  <div class="container">
    <h1>Welcome, {{ $user->first_name }}!</h1>

    <p>There are a total of <strong>{{ $count['users'] }}</strong> applicants in the system.</p>
    <p>{!! link_to_route('applications.index', 'View all Applications', null, ['class' => 'btn btn-primary btn-lg']) !!}</p>
  </div>
</div>

@stop

@section('main_content')

  <div class="container">
    <div class="row">
      <p>Below are counts of certain subsets of users and nominators. Some of these subsets overlap. The total number of applicants can be found above.</p>
       <table class="table table-striped">
        <thead>
          <tr>
            <th>Record</th>
            <th>Count</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td> Started Applications </td>
            <td> {{ $count['apps'] }} </td>
          </tr>
           <tr>
            <td> Total Nominations </td>
            <td> {{ $count['noms'] }} </td>
          </tr>
          <tr>
            <td> Unique Nominees </td>
            <td> {{ $count['unique_noms'] }} </td>
          </tr>
          <tr>
            <td> Unique Nominators </td>
            <td> {{ $count['unique_recs'] }} </td>
          </tr>
          <tr>
            <td> Submitted Applications (including those that are submitted AND completed)</td>
            <td> {{ $count['submitted_apps'] }} </td>
          </tr>
          <tr>
            <td> Completed Applications <em> (These are DONE. Submitted AND completed.) </em> </td>
            <td> {{ $count['completed_apps'] }} </td>
          </tr>
          <tr>
            <td> Applications with one requested recommendation <em> (could have requested a second recommendation that is complete) </em></td>
            <td> {{ $count['requested_one'] }} </td>
          </tr>
           <tr>
            <td> Applications with one completed recommendation <em>(could have requested a second recommendation that is incomplete)</em></td>
            <td> {{ $count['submitted_one'] }} </td>
          </tr>
          <tr>
            <td> Applications with two requested recommendations <em>(both unfinished)</em></td>
            <td> {{ $count['requested_two'] }} </td>
          </tr>
          <tr>
            <td> Applications with two completed recommendations </td>
            <td> {{ $count['submitted_two'] }}  </td>
          </tr>

        </tbody>
       </table>


    </div>

    @include('admin.layouts.partials.footer')
  </div>

@stop
