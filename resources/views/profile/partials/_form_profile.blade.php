  {{-- Birthdate --}}
  <div class="field-group -dual -alpha {{ setInvalidClass('birthdate', $errors) }}">
    {!! Form::label('birthdate', 'Birthdate: ') !!}
    {!! Form::input('date', 'birthdate', null, ['placeholder' => 'MM/DD/YYYY']) !!}
    {!! errorsFor('birthdate', $errors); !!}
  </div>

  {{-- Phone Number --}}
  <div class="field-group -dual -beta {{ setInvalidClass('phone', $errors) }}">
    {!! Form::label('phone', 'Phone Number (no dashes): ') !!}
    {!! Form::text('phone', null, ['placeholder' => '3215551234']) !!}
    {!! errorsFor('phone', $errors); !!}
  </div>

  {{-- Address Street --}}
  <div class="field-group {{ setInvalidClass('address_street', $errors) }}">
    {!! Form::label('address_street', 'Address 1 - street address: ') !!}
    {!! Form::text('address_street') !!}
    {!! errorsFor('address_street', $errors); !!}
  </div>

  {{-- Address Premise --}}
  <div class="field-group {{ setInvalidClass('address_premise', $errors) }}">
    {!! Form::label('address_premise', 'Address 2 - apt, suite, or floor: ') !!}
    {!! Form::text('address_premise') !!}
    {!! errorsFor('address_premise', $errors); !!}
  </div>

  {{-- City --}}
  <div class="field-group -dual -alpha {{ setInvalidClass('city', $errors) }}">
    {!! Form::label('city', 'City: ') !!}
    {!! Form::text('city') !!}
    {!! errorsFor('city', $errors); !!}
  </div>

  {{-- State --}}
  <div class="field-group -dual -beta {{ setInvalidClass('state', $errors) }}">
    {!! Form::label('state', 'State: ') !!}
    {!! Form::select('state', $states); !!}
    {!! errorsFor('state', $errors); !!}
  </div>

  {{-- Zip --}}
  <div class="field-group {{ setInvalidClass('zip', $errors) }}">
    {!! Form::label('zip', 'Zip: ') !!}
    {!! Form::text('zip') !!}
    {!! errorsFor('zip', $errors); !!}
  </div>

  {{-- Gender --}}
  <div class="field-group -mono {{ setInvalidClass('gender', $errors) }}">
    {!! Form::label('gender', 'Gender: ') !!}
    {!! Form::select('gender', array('M' => 'Male', 'F' => 'Female')); !!}
    {!! errorsFor('gender', $errors); !!}
  </div>

  {{-- Race --}}
  <div>
    <p>Of the following options, which best describes your race? (Check all that apply) <em>(optional)</em></p>
    @foreach($races as $key => $race)
      <div class="field-group">
          {!! Form::label('race['. $key . ']', ' ') !!}
          @if(isset($user_races) && in_array($race, $user_races))
              {!! Form::checkbox('race['. $key . ']', $race, true) !!}
              {{ $race }}
          @else
            {!! Form::checkbox('race['. $key . ']', $race, false) !!}
            {{ $race }}
          @endif
      </div>
    @endforeach
  </div>

  {{-- School --}}
  <div class="field-group {{ setInvalidClass('school', $errors) }}">
    {!! Form::label('school', 'Name of Current School: ') !!}
    {!! Form::text('school') !!}
    {!! errorsFor('school', $errors); !!}
  </div>

  {{-- Grade --}}
  <div class="field-group -mono {{ setInvalidClass('grade', $errors) }}">
    {!! Form::label('grade', 'Current Grade: ') !!}
    {!! Form::selectRange('grade', 9, 12); !!}
    {!! errorsFor('grade', $errors); !!}
  </div>
