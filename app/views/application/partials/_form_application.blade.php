  {{-- Accomplishments --}}
  <div class="field-group">
    {{ Form::label('accomplishments', $scholarship->label_app_accomplishments) }}
    {{ Form::textarea('accomplishments') }}
    {{ errorsFor('accomplishments', $errors); }}
  </div>


  {{-- GPA --}}
  <div class="field-group -mono">
    {{ Form::label('gpa', 'GPA: ') }}
    {{ Form::text('gpa') }}
    {{ errorsFor('gpa', $errors); }}
  </div>

  {{-- Test Type --}}
  <div class="field-group -dual -alpha">
    {{ Form::label('test_type', 'Test Type: ') }}
    {{ Form::select('test_type', array('SAT' => 'SAT', 'ACT' => 'ACT')); }}
    {{ errorsFor('test_type', $errors); }}
  </div>

  {{-- Test Score --}}
  <div class="field-group -dual -beta">
    {{ Form::label('test_score', 'Test Score: ') }}
    {{ Form::text('test_score') }}
    {{ errorsFor('test_score', $errors); }}
  </div>


  {{-- Activities --}}
  <div class="field-group">
    {{ Form::label('activities', $scholarship->label_app_activities) }}
    {{ Form::textarea('activities') }}
    {{ errorsFor('activities', $errors); }}
  </div>

  {{-- Essay 1 --}}
  <div class="field-group">
    {{ Form::label('essay1', $scholarship->label_app_essay1) }}
    {{ Form::textarea('essay1') }}
    {{ errorsFor('essay1', $errors); }}
  </div>


  {{-- Essay 2 --}}
  <div class="field-group">
    {{ Form::label('essay2', $scholarship->label_app_essay2) }}
    {{ Form::textarea('essay2') }}
    {{ errorsFor('essay2', $errors); }}
  </div>
