@extends('admin.layouts.master')

@section('jumbotron')

<div class="jumbotron">
  <div class="container">
    <h1>Welcome, {{ $user->first_name }}!</h1>

    <h2>There are a total of <strong>{{ $count['users'] }}</strong> applicants in the system.</h2>
    <p>An applicant is any user of the site who has started the application process by creating an account (not a nominator, recommender, or admin). A user could have started their application after being nominated. If there have been new applicants and you refresh the page, this number will go up.</p>
    <p>{!! link_to_route('applications.index', 'View all Applications', null, ['class' => 'btn btn-primary btn-lg']) !!}</p>
  </div>
</div>

@stop

@section('main_content')

  <div class="container">
    <div class="row">
      <p>Below are counts of certain subsets. Some of the subsets overlap, so you cannot add up the counts to get total applicants. The total number of applicants can be found above. Like the total number of applicants, all numbers below will update upon page refresh.</p>
       <table class="table table-striped">
        <thead>
          <tr>
            <th>Record</th>
            <th>Count</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td> Started Applications <em>(This includes both incomplete and completed applications.)</em></td>
            <td> {{ $count['apps'] }} </td>
          </tr>
           <tr>
            <td> Total Nominations <em>(This is the total number of people who have been nominated, because people can be nominated more than once, this number is not unique. They may or may not have started an application.)</em></td>
            <td> {{ $count['noms'] }} </td>
          </tr>
          <tr>
            <td> Unique Nominees <em>(Someone who was nominated to apply for the scholarship through the "Nominate a Star" feature. Is not necessarily an applicant (hasn't necessarily created an account), but could be. May have been nominated by more than one person.)</em></td>
            <td> {{ $count['unique_noms'] }} </td>
          </tr>
          <tr>
            <td> Unique Nominators <em>(A user who came to the site to nominate someone to apply for the scholarship. They entered their name and email and a potential applicant's name and email. May have nominated more than one person.)</em></td>
            <td> {{ $count['unique_recs'] }} </td>
          </tr>
          <tr>
            <td> Submitted Applications <em>(These are applications that are completely done on the applicant's end, they might be waiting on recommendations.)</em></td>
            <td> {{ $count['submitted_apps'] }} </td>
          </tr>
          <tr>
            <td> Completed Applications <em> (These are DONE. Submitted AND completed.) </em> </td>
            <td> {{ $count['completed_apps'] }} </td>
          </tr>
          <tr>
            <td> Applications with exactly one requested recommendation that is incomplete <em> (Could have requested a second recommendation that is complete.) </em></td>
            <td> {{ $count['requested_one'] }} </td>
          </tr>
           <tr>
            <td> Applications with exactly one completed recommendation <em>(Could have requested a second recommendation that is incomplete.)</em></td>
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
