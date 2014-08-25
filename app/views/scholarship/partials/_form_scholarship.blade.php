  {{-- Title --}}
  <div>
    {{ Form::label('title', 'Scholarship Title: ') }}
    {{ Form::text('title') }}
    {{ errorsFor('title', $errors); }}
  </div>

  {{-- Description --}}
  <div>
    {{ Form::label('description', 'Description: ') }}
    {{ Form::textarea('description') }}
    {{ errorsFor('description', $errors); }}
  </div>


    {{-- Scholarship Amount --}}
    <div>
      {{ Form::label('amount_scholarship', 'Scholarship Amount $: ') }}
      {{ Form::text('amount_scholarship') }}
      {{ errorsFor('amount_scholarship', $errors); }}
    </div>


  {{-- Application Start Date --}}
  <div>
    {{ Form::label('application_start', ' Application Start date: ') }}
    {{ Form::input('date', 'application_start') }}
    {{ errorsFor('application_start', $errors); }}
  </div>

  {{-- Application End Date --}}
  <div>
    {{ Form::label('application_end', ' Application End date: ') }}
    {{ Form::input('date', 'application_end') }}
    {{ errorsFor('application_end', $errors); }}
  </div>

  {{-- Announce Winner Date --}}
  <div>
    {{ Form::label('winners_announced', 'Winners Announced Date: ') }}
    {{ Form::input('date', 'winners_announced') }}
    {{ errorsFor('winners_announced', $errors); }}
  </div>

  {{-- Minimum Age --}}
  <div>
    {{ Form::label('age_min', 'Minimum Age: ') }}
    {{ Form::selectRange('age_min', 13, 20); }}
    {{ errorsFor('age_min', $errors); }}
  </div>

  {{-- Maximum Age --}}
  <div>
    {{ Form::label('age_max', 'Maximum Age: ') }}
    {{ Form::selectRange('age_max', 18, 25); }}
    {{ errorsFor('age_max', $errors); }}
  </div>

  {{-- Minimum number of Recomendations --}}
  <div>
    {{ Form::label('num_recommendations_min', 'Minimum number of Recomendations: ') }}
    {{ Form::selectRange('num_recommendations_min', 1, 3); }}
    {{ errorsFor('num_recommendations_min', $errors); }}
  </div>

  {{-- Maximum number of Recomendations --}}
  <div>
    {{ Form::label('num_recommendations_max', ' Maximum number of Recomendations : ') }}
    {{ Form::selectRange('num_recommendations_max', 1, 4); }}
    {{ errorsFor('num_recommendations_max', $errors); }}
  </div>

  {{-- Maximum number of Recomendations --}}
  <div>
    {{ Form::label('gpa_min', ' GPA Minimum : ') }}
    {{ Form::selectRange('gpa_min', 3, 4); }} {{-- @TODO: figure out how to put a float here --}}
    {{ errorsFor('gpa_min', $errors); }}
  </div>


 {{-- @TODO: Make this a group! --}}


  {{-- Accomplisments Label --}}
  <div>
    {{ Form::label('label_app_accomplishments', 'Accomplisments Label: ') }}
    {{ Form::text('label_app_accomplishments') }}
    {{ errorsFor('label_app_accomplishments', $errors); }}
  </div>

  {{-- Activities Label --}}
  <div>
    {{ Form::label('label_app_activities', 'Activities Label: ') }}
    {{ Form::text('label_app_activities') }}
    {{ errorsFor('label_app_activities', $errors); }}
  </div>

  {{-- Essay 1 Label --}}
  <div>
    {{ Form::label('label_app_essay1', 'Essay 1 Label: ') }}
    {{ Form::text('label_app_essay1') }}
    {{ errorsFor('label_app_essay1', $errors); }}
  </div>

  {{-- Essay 2 Label --}}
  <div>
    {{ Form::label('label_app_essay2', 'Essay 2 Label: ') }}
    {{ Form::text('label_app_essay2') }}
    {{ errorsFor('label_app_essay2', $errors); }}
  </div>


  {{-- Recomendation Rank Character Label --}}
  <div>
    {{ Form::label('label_rec_rank_character', 'Recomendation Rank Character Label: ') }}
    {{ Form::text('label_rec_rank_character') }}
    {{ errorsFor('label_rec_rank_character', $errors); }}
  </div>


  {{-- Recomendation Rank Additional Label --}}
  <div>
    {{ Form::label('label_rec_rank_additional', 'Recomendation Rank Additional Label: ') }}
    {{ Form::text('label_rec_rank_additional') }}
    {{ errorsFor('label_rec_rank_additional', $errors); }}
  </div>

  {{-- Recomendation Essay 1 Label --}}
  <div>
    {{ Form::label('label_rec_essay1', 'Recomendation Essay 1 Label: ') }}
    {{ Form::text('label_rec_essay1') }}
    {{ errorsFor('label_rec_essay1', $errors); }}
  </div>
