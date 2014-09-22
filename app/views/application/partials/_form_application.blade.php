  {{-- Accomplishments --}}
  <div class="field-group {{ setInvalidClass('accomplishments', $errors) }}">
    {{ Form::label('accomplishments', $scholarship->label_app_accomplishments) }}
    {{ Form::textarea('accomplishments') }}
    {{ errorsFor('accomplishments', $errors); }}
  </div>


  {{-- GPA --}}
  <div class="field-group -mono {{ setInvalidClass('gpa', $errors) }}">
    {{ Form::label('gpa', 'GPA: ') }}
    {{ Form::text('gpa') }}
    {{ errorsFor('gpa', $errors); }}
  </div>

  {{-- Test Type --}}
  <div class="field-group -dual -alpha {{ setInvalidClass('test_type', $errors) }}">
    {{ Form::label('test_type', 'Test Type: (optional) ') }}
    {{ Form::select('test_type', array('PSAT' => 'PSAT', 'SAT' => 'SAT', 'PLAN' => 'PLAN', 'ACT' => 'ACT')); }}
    {{ errorsFor('test_type', $errors); }}
  </div>

  {{-- Test Score --}}
  <div class="field-group -dual -beta {{ setInvalidClass('test_score', $errors) }}">
    {{ Form::label('test_score', 'Test Score: (optional)') }}
    {{ Form::text('test_score') }}
    {{ errorsFor('test_score', $errors); }}
  </div>


  {{-- Activities --}}
  <div class="field-group {{ setInvalidClass('activities', $errors) }}">
    {{ Form::label('activities', $scholarship->label_app_activities) }}
    {{ Form::textarea('activities') }}
    {{ errorsFor('activities', $errors); }}
  </div>

  {{-- Essay 1 --}}
  <div class="field-group {{ setInvalidClass('essay1', $errors) }}">
    {{ Form::label('essay1', $scholarship->label_app_essay1) }}
    {{ Form::textarea('essay1') }}
    {{ errorsFor('essay1', $errors); }}
  </div>


  {{-- Essay 2 --}}
  <div class="field-group {{ setInvalidClass('essay2', $errors) }}">
    {{ Form::label('essay2', $scholarship->label_app_essay2) }}
    {{ Form::textarea('essay2') }}
    {{ errorsFor('essay2', $errors); }}
  </div>

    {{-- Link --}}
  <div class="field-group {{ setInvalidClass('link', $errors) }}">
    {{ Form::label('link', 'Link (youtube or vimeo)') }}
    {{ Form::text('link',  NULL, ['placeholder' => 'http://youtube.com']) }}
    {{ errorsFor('link', $errors); }}
  </div>

    {{-- Hear About --}}
  <div class="field-group -dual -alpha {{ setInvalidClass('hear_about', $errors) }}">
    {{ Form::label('hear_about', 'How did you hear about this scholarship? (optional) ') }}
    {{ Form::select('hear_about',  $choices); }}
    {{ errorsFor('test_hear_abouttype', $errors); }}
  </div>

  {{-- Checklist --}}
  <div class="field-group -checkbox">
    {{ Form::checkbox('documentation', 1, false, ['id' => 'eligibility']); }}
    {{ Form::label('documentation', "If you are chosen as a winner, you will submit a copy of your driver's license, birth certificate or passport as proof of age and U.S. citizenship/permanent legal resident status.") }}
    {{ errorsFor('documentation', $errors); }}
  </div>

  <div class="field-group -checkbox">
    {{ Form::checkbox('factual', 1, false, ['id' => 'eligibility']); }}
    {{ Form::label('factual', "You confirm that everything written in the application is true and factual.") }}
    {{ errorsFor('factual', $errors); }}
  </div>

  <div class="field-group -checkbox">
    {{ Form::checkbox('media_release', 1, false, ['id' => 'eligibility']); }}
    {{ Form::label('media_release', "Foot Locker and TMI may use your application in any media or public relations campaigns.") }}
    {{ errorsFor('media_release', $errors); }}
  </div>

  <div class="field-group -checkbox">
    {{ Form::checkbox('rules', 1, false, ['id' => 'eligibility']); }}
    {{ Form::label('rules', "Check out the official rules [link]") }}
    {{ errorsFor('rules', $errors); }}
  </div>



