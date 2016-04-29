  {{-- Accomplishments --}}
  <div class="field-group {{ setInvalidClass('accomplishments', $errors) }}">
    {!! Form::label('accomplishments', $label['accomplishments']) !!}
    {!! Form::textarea('accomplishments') !!}
    {!! errorsFor('accomplishments', $errors); !!}
  </div>


  {{-- GPA --}}
  <div class="field-group -mono {{ setInvalidClass('gpa', $errors) }}">
    {!! Form::label('gpa', 'GPA (please enter your GPA on a 4.0 or 5.0 scale)') !!}
    {!! Form::text('gpa') !!}
    {!! errorsFor('gpa', $errors); !!}
  </div>

  {{-- Test Type --}}
  <div class="field-group -mono {{ setInvalidClass('test_type', $errors) }}">
    {!! Form::label('test_type', 'Test Type:') !!}
    {!! Form::select('test_type', array('PSAT' => 'PSAT', 'SAT' => 'SAT', 'PLAN' => 'PLAN', 'ACT' => 'ACT', 'Prefer not to submit scores' => 'Prefer not to submit scores')); !!}
    {!! errorsFor('test_type', $errors); !!}
  </div>

  {{-- Test Score --}}
  <div class="field-group -mono {{ setInvalidClass('test_score', $errors) }}">
    {!! Form::label('test_score', 'Test Score:') !!}
    {!! Form::text('test_score') !!}
    {!! errorsFor('test_score', $errors); !!}
  </div>


  {{-- Activities --}}
  <div class="field-group {{ setInvalidClass('activities', $errors) }}">
    {!! Form::label('activities', $label['activities']) !!}
    {!! Form::textarea('activities') !!}
    {!! errorsFor('activities', $errors); !!}
  </div>

    {{-- Participation --}}
  <div class="field-group {{ setInvalidClass('activities', $errors) }}">
    {!! Form::label('participation', $label['participation']) !!}
    {!! Form::textarea('participation') !!}
    {!! errorsFor('participation', $errors); !!}
  </div>

  {{-- Essay 1 --}}
  <div class="field-group {{ setInvalidClass('essay1', $errors) }}">
    {!! Form::label('essay1', $label['essay1']) !!}
    {!! Form::textarea('essay1') !!}
    {!! errorsFor('essay1', $errors); !!}
  </div>


  {{-- Essay 2 --}}
  <div class="field-group {{ setInvalidClass('essay2', $errors) }}">
    {!! Form::label('essay2', $label['essay2']) !!}
    {!! Form::textarea('essay2') !!}
    {!! errorsFor('essay2', $errors); !!}
  </div>

  {{-- Upload --}}
  @if (isset($uploads) && !is_null($uploads))
    <p>Uploaded Images</p>
    @foreach ($uploads as $upload)
      <div class="image-holder">
        <img src="/storage/app/uploads/{{$user->id}}/{{$upload}}" alt="uploaded image">
        <p>Remove?</p>
        {!! Form::checkbox('remove[]', $upload) !!}
      </div>
      <br>
    @endforeach
    <div class="field-group">
      {!! Form::label('upload', 'Additional photos (optional)') !!}
      {!! Form::file('upload') !!}
      {!! errorsFor('upload', $errors); !!}
    </div>
  @else
    <div class="field-group">
      {!! Form::label('upload', 'Photos (optional)') !!}
      {!! Form::file('upload') !!}
      {!! errorsFor('upload', $errors); !!}
    </div>
  @endif

  {{-- Hear About --}}
  <div class="field-group -mono {{ setInvalidClass('hear_about', $errors) }}">
    {!! Form::label('hear_about', 'How did you hear about this scholarship? (optional) ') !!}
    {!! Form::select('hear_about',  $choices); !!}
    {!! errorsFor('test_hear_abouttype', $errors); !!}
  </div>



