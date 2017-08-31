{{-- Title --}}
<div class="form-group">
  {!! Form::label('title', 'Scholarship Title: ') !!}
  {!! Form::text('title', null, ['class' => 'form-control']) !!}
  {!! errorsFor('title', $errors); !!}
</div>

{{-- Description --}}
<div class="form-group">
  {!! Form::label('description', 'Description: ') !!}
  {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
  {!! errorsFor('description', $errors); !!}
</div>

{{-- From Email Address --}}
<div class="form-group">
  {!! Form::label('email_from_address', 'Address emails are sent from: ') !!}
  {!! Form::text('email_from_address', null, ['class' => 'form-control']) !!}
  {!! errorsFor('email_from_address', $errors); !!}
</div>

{{-- From Email Name --}}
<div class="form-group">
  {!! Form::label('email_from_name', 'Name emails are sent from: ') !!}
  {!! Form::text('email_from_name', null, ['class' => 'form-control']) !!}
  {!! errorsFor('email_from_name', $errors); !!}
</div>

{{-- Scholarship Amount --}}
<div class="form-group">
  {!! Form::label('amount_scholarship', 'Scholarship Amount $: ') !!}
  {!! Form::text('amount_scholarship', null, ['class' => 'form-control']) !!}
  {!! errorsFor('amount_scholarship', $errors); !!}
</div>

{{-- Application Start Date --}}
<div class="form-group">
  {!! Form::label('application_start', ' Application Start date: ') !!}
  {!! Form::input('date', 'application_start', null, ['class' => 'form-control']) !!}
  {!! errorsFor('application_start', $errors); !!}
</div>

{{-- Application End Date --}}
<div class="form-group">
  {!! Form::label('application_end', ' Application End date: ') !!}
  {!! Form::input('date', 'application_end', null, ['class' => 'form-control']) !!}
  {!! errorsFor('application_end', $errors); !!}
</div>

{{-- Nomination End Date --}}
<div class="form-group">
  {!! Form::label('nomination_end', ' Nomination End date: ') !!}
  {!! Form::input('date', 'nomination_end', null, ['class' => 'form-control']) !!}
  {!! errorsFor('nomination_end', $errors); !!}
</div>

{{-- Announce Winner Date --}}
<div class="form-group">
  {!! Form::label('winners_announced', 'Winners Announced Date: ') !!}
  {!! Form::input('date', 'winners_announced', null, ['class' => 'form-control']) !!}
  {!! errorsFor('winners_announced', $errors); !!}
</div>

{{-- Minimum Age --}}
<div class="form-group">
  {!! Form::label('age_min', 'Minimum Age: ') !!}
  {!! Form::selectRange('age_min', 13, 20, null, ['class' => 'form-control']); !!}
  {!! errorsFor('age_min', $errors); !!}
</div>

{{-- Maximum Age --}}
<div class="form-group">
  {!! Form::label('age_max', 'Maximum Age: ') !!}
  {!! Form::selectRange('age_max', 18, 25, null, ['class' => 'form-control']); !!}
  {!! errorsFor('age_max', $errors); !!}
</div>

{{-- Minimum number of Recommendations --}}
<div class="form-group">
  {!! Form::label('num_recommendations_min', 'Minimum number of Recommendations: ') !!}
  {!! Form::selectRange('num_recommendations_min', 1, 3, null, ['class' => 'form-control']); !!}
  {!! errorsFor('num_recommendations_min', $errors); !!}
</div>

{{-- Maximum number of Recommendations --}}
<div class="form-group">
  {!! Form::label('num_recommendations_max', ' Maximum number of Recommendations : ') !!}
  {!! Form::selectRange('num_recommendations_max', 1, 4, null, ['class' => 'form-control']); !!}
  {!! errorsFor('num_recommendations_max', $errors); !!}
</div>

{{-- Maximum number of Recommendations --}}
<div class="form-group">
  {!! Form::label('gpa_min', ' GPA Minimum : ') !!}
  {{-- @TODO: figure out how to put a float here --}}
  {!! Form::select('gpa_min', array('3.0', '3.1', '3.2', '3.3', '3.4', '3.5', '3.6', '3.7', '3.8', '3.9'), null, ['class' => 'form-control']); !!}
  {!! errorsFor('gpa_min', $errors); !!}
</div>

{{-- @TODO: Make this a group! --}}

{{-- Accomplishments Label --}}
<div class="form-group">
  {!! Form::label('label_app_accomplishments', 'Accomplishments Label: ') !!}
  {!! Form::text('label_app_accomplishments', null, ['class' => 'form-control']) !!}
  {!! errorsFor('label_app_accomplishments', $errors); !!}
</div>

{{-- Activities Label --}}
<div class="form-group">
  {!! Form::label('label_app_activities', 'Activities Label: ') !!}
  {!! Form::text('label_app_activities', null, ['class' => 'form-control']) !!}
  {!! errorsFor('label_app_activities', $errors); !!}
</div>

{{-- Participation Label --}}
<div class="form-group">
  {!! Form::label('label_app_participation', 'Participation Label: ') !!}
  {!! Form::text('label_app_participation', null, ['class' => 'form-control']) !!}
  {!! errorsFor('label_app_participation', $errors); !!}
</div>

{{-- Essay 1 Label --}}
<div class="form-group">
  {!! Form::label('label_app_essay1', 'Essay 1 Label: ') !!}
  {!! Form::text('label_app_essay1', null, ['class' => 'form-control']) !!}
  {!! errorsFor('label_app_essay1', $errors); !!}
</div>

{{-- Essay 2 Label --}}
<div class="form-group">
  {!! Form::label('label_app_essay2', 'Essay 2 Label: ') !!}
  {!! Form::text('label_app_essay2', null, ['class' => 'form-control']) !!}
  {!! errorsFor('label_app_essay2', $errors); !!}
</div>

{{-- Image Uploads --}}
<div class="form-group">
  {!! Form::label('image_uploads', 'Allow applicants to upload images') !!}
  {!! Form::checkbox('image_uploads', 1, $scholarship->image_uploads) !!}
  {!! errorsFor('image_uploads', $errors); !!}
</div>

{{-- Recommendation Rank Character Label --}}
<div class="form-group">
  {!! Form::label('label_rec_rank_character', 'Recommendation Rank Character Label: ') !!}
  {!! Form::text('label_rec_rank_character', null, ['class' => 'form-control']) !!}
  {!! errorsFor('label_rec_rank_character', $errors); !!}
</div>

{{-- Recommendation Rank Additional Label --}}
<div class="form-group">
  {!! Form::label('label_rec_rank_additional', 'Recommendation Rank Additional Label: ') !!}
  {!! Form::text('label_rec_rank_additional', null, ['class' => 'form-control']) !!}
  {!! errorsFor('label_rec_rank_additional', $errors); !!}
</div>

{{-- Recommendation Essay 1 Label --}}
<div class="form-group">
  {!! Form::label('label_rec_essay1', 'Recommendation Essay 1 Label: ') !!}
  {!! Form::text('label_rec_essay1', null, ['class' => 'form-control']) !!}
  {!! errorsFor('label_rec_essay1', $errors); !!}
</div>

{{-- Recommendation Optional question --}}
<div class="form-group">
  {!! Form::label('display_optional_rec_question', 'Display optional recommendation question') !!}
  {!! Form::checkbox('display_optional_rec_question', 1, $scholarship->display_optional_rec_question) !!}
  {!! errorsFor('display_optional_rec_question', $errors); !!}
</div>
<div class="form-group">
  {!! Form::label('label_rec_optional_question', 'Recommendation Optional Question Label: ') !!}
  {!! Form::text('label_rec_optional_question', null, ['class' => 'form-control']) !!}
  {!! errorsFor('label_rec_optional_question', $errors); !!}
</div>


{{-- How did you hear options? --}}
<div class="form-group">
  {!! Form::label('hear_about_options', 'Hear about this options (comma seperated list) ') !!}
  {!! Form::text('hear_about_options', null, ['class' => 'form-control']) !!}
  {!! errorsFor('hear_about_options', $errors); !!}
</div>