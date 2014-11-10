  {{-- Accomplishments --}}
  <div class="field-group {{ setInvalidClass('accomplishments', $errors) }}">
    {{ Form::label('accomplishments', $label['accomplishments']) }}
    {{ Form::textarea('accomplishments') }}
    {{ errorsFor('accomplishments', $errors); }}
  </div>


  {{-- GPA --}}
  <div class="field-group -mono {{ setInvalidClass('gpa', $errors) }}">
    {{ Form::label('gpa', 'Unweighted GPA: ') }}
    {{ Form::text('gpa') }}
    {{ errorsFor('gpa', $errors); }}
  </div>

  {{-- Test Type --}}
  <div class="field-group -mono {{ setInvalidClass('test_type', $errors) }}">
    {{ Form::label('test_type', 'Test Type: (optional) ') }}
    {{ Form::select('test_type', array('PSAT' => 'PSAT', 'SAT' => 'SAT', 'PLAN' => 'PLAN', 'ACT' => 'ACT')); }}
    {{ errorsFor('test_type', $errors); }}
  </div>

  {{-- Test Score --}}
  <div class="field-group -mono {{ setInvalidClass('test_score', $errors) }}">
    {{ Form::label('test_score', 'Test Score: (optional)') }}
    {{ Form::text('test_score') }}
    {{ errorsFor('test_score', $errors); }}
  </div>


  {{-- Activities --}}
  <div class="field-group {{ setInvalidClass('activities', $errors) }}">
    {{ Form::label('activities', $label['activities']) }}
    {{ Form::textarea('activities') }}
    {{ errorsFor('activities', $errors); }}
  </div>

    {{-- Participation --}}
  <div class="field-group {{ setInvalidClass('activities', $errors) }}">
    {{ Form::label('participation', $label['participation']) }}
    {{ Form::textarea('participation') }}
    {{ errorsFor('participation', $errors); }}
  </div>

  {{-- Essay 1 --}}
  <div class="field-group {{ setInvalidClass('essay1', $errors) }}">
    {{ HTML::decode(Form::label('essay1', $label['essay1'])) }}
    {{ Form::textarea('essay1') }}
    {{ errorsFor('essay1', $errors); }}
  </div>


  {{-- Essay 2 --}}
  <div class="field-group {{ setInvalidClass('essay2', $errors) }}">
    {{ Form::label('essay2', $label['essay2']) }}
    {{ Form::textarea('essay2') }}
    {{ errorsFor('essay2', $errors); }}
  </div>

    {{-- Link --}}
  <div class="field-group {{ setInvalidClass('link', $errors) }}">
    {{ Form::label('link', 'Links to photo or video albums (optional)') }}
    {{ Form::text('link',  NULL, ['placeholder' => 'http://youtube.com']) }}
    {{ errorsFor('link', $errors); }}
  </div>

    {{-- Hear About --}}
  <div class="field-group -mono {{ setInvalidClass('hear_about', $errors) }}">
    {{ Form::label('hear_about', 'How did you hear about this scholarship? (optional) ') }}
    {{ Form::select('hear_about',  $choices); }}
    {{ errorsFor('test_hear_abouttype', $errors); }}
  </div>



