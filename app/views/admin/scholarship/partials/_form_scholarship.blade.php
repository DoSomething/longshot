{{-- Title --}}
<div class="form-group">
  {{ Form::label('title', 'Scholarship Title: ') }}
  {{ Form::text('title', null, ['class' => 'form-control']) }}
  {{ errorsFor('title', $errors); }}
</div>

{{-- Description --}}
<div class="form-group">
  {{ Form::label('description', 'Description: ') }}
  {{ Form::textarea('description', null, ['class' => 'form-control']) }}
  {{ errorsFor('description', $errors); }}
</div>

{{-- Scholarship Amount --}}
<div class="form-group">
  {{ Form::label('amount_scholarship', 'Scholarship Amount $: ') }}
  {{ Form::text('amount_scholarship', null, ['class' => 'form-control']) }}
  {{ errorsFor('amount_scholarship', $errors); }}
</div>

{{-- Application Start Date --}}
<div class="form-group">
  {{ Form::label('application_start', ' Application Start date: ') }}
  {{ Form::input('date', 'application_start', null, ['class' => 'form-control']) }}
  {{ errorsFor('application_start', $errors); }}
</div>

{{-- Application End Date --}}
<div class="form-group">
  {{ Form::label('application_end', ' Application End date: ') }}
  {{ Form::input('date', 'application_end', null, ['class' => 'form-control']) }}
  {{ errorsFor('application_end', $errors); }}
</div>

{{-- Announce Winner Date --}}
<div class="form-group">
  {{ Form::label('winners_announced', 'Winners Announced Date: ') }}
  {{ Form::input('date', 'winners_announced', null, ['class' => 'form-control']) }}
  {{ errorsFor('winners_announced', $errors); }}
</div>

{{-- Minimum Age --}}
<div class="form-group">
  {{ Form::label('age_min', 'Minimum Age: ') }}
  {{ Form::selectRange('age_min', 13, 20, null, ['class' => 'form-control']); }}
  {{ errorsFor('age_min', $errors); }}
</div>

{{-- Maximum Age --}}
<div class="form-group">
  {{ Form::label('age_max', 'Maximum Age: ') }}
  {{ Form::selectRange('age_max', 18, 25, null, ['class' => 'form-control']); }}
  {{ errorsFor('age_max', $errors); }}
</div>

{{-- Minimum number of Recomendations --}}
<div class="form-group">
  {{ Form::label('num_recommendations_min', 'Minimum number of Recomendations: ') }}
  {{ Form::selectRange('num_recommendations_min', 1, 3, null, ['class' => 'form-control']); }}
  {{ errorsFor('num_recommendations_min', $errors); }}
</div>

{{-- Maximum number of Recomendations --}}
<div class="form-group">
  {{ Form::label('num_recommendations_max', ' Maximum number of Recomendations : ') }}
  {{ Form::selectRange('num_recommendations_max', 1, 4, null, ['class' => 'form-control']); }}
  {{ errorsFor('num_recommendations_max', $errors); }}
</div>

{{-- Maximum number of Recomendations --}}
<div class="form-group">
  {{ Form::label('gpa_min', ' GPA Minimum : ') }}
  {{-- @TODO: figure out how to put a float here --}}
  {{ Form::select('gpa_min', array('3.0', '3.1', '3.2', '3.3', '3.4', '3.5', '3.6', '3.7', '3.8', '3.9'), null, ['class' => 'form-control']); }}
  {{ errorsFor('gpa_min', $errors); }}
</div>

{{-- @TODO: Make this a group! --}}

{{-- Accomplisments Label --}}
<div class="form-group">
  {{ Form::label('label_app_accomplishments', 'Accomplisments Label: ') }}
  {{ Form::text('label_app_accomplishments', null, ['class' => 'form-control']) }}
  {{ errorsFor('label_app_accomplishments', $errors); }}
</div>

{{-- Activities Label --}}
<div class="form-group">
  {{ Form::label('label_app_activities', 'Activities Label: ') }}
  {{ Form::text('label_app_activities', null, ['class' => 'form-control']) }}
  {{ errorsFor('label_app_activities', $errors); }}
</div>

{{-- Participation Label --}}
<div class="form-group">
  {{ Form::label('label_app_participation', 'Participation Label: ') }}
  {{ Form::text('label_app_participation', null, ['class' => 'form-control']) }}
  {{ errorsFor('label_app_participation', $errors); }}
</div>

{{-- Essay 1 Label --}}
<div class="form-group">
  {{ Form::label('label_app_essay1', 'Essay 1 Label: ') }}
  {{ Form::text('label_app_essay1', null, ['class' => 'form-control']) }}
  {{ errorsFor('label_app_essay1', $errors); }}
</div>

{{-- Essay 2 Label --}}
<div class="form-group">
  {{ Form::label('label_app_essay2', 'Essay 2 Label: ') }}
  {{ Form::text('label_app_essay2', null, ['class' => 'form-control']) }}
  {{ errorsFor('label_app_essay2', $errors); }}
</div>

{{-- Recomendation Rank Character Label --}}
<div class="form-group">
  {{ Form::label('label_rec_rank_character', 'Recomendation Rank Character Label: ') }}
  {{ Form::text('label_rec_rank_character', null, ['class' => 'form-control']) }}
  {{ errorsFor('label_rec_rank_character', $errors); }}
</div>

{{-- Recomendation Rank Additional Label --}}
<div class="form-group">
  {{ Form::label('label_rec_rank_additional', 'Recomendation Rank Additional Label: ') }}
  {{ Form::text('label_rec_rank_additional', null, ['class' => 'form-control']) }}
  {{ errorsFor('label_rec_rank_additional', $errors); }}
</div>

{{-- Recomendation Essay 1 Label --}}
<div class="form-group">
  {{ Form::label('label_rec_essay1', 'Recomendation Essay 1 Label: ') }}
  {{ Form::text('label_rec_essay1', null, ['class' => 'form-control']) }}
  {{ errorsFor('label_rec_essay1', $errors); }}
</div>

{{-- How did you hear options? --}}
<div class="form-group">
  {{ Form::label('hear_about_options', 'Hear about this options (comma seperated list) ') }}
  {{ Form::text('hear_about_options', null, ['class' => 'form-control']) }}
  {{ errorsFor('hear_about_options', $errors); }}
</div>