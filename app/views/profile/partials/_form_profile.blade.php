
  {{-- Birthdate --}}
  <div class="field-group -mono">
    {{ Form::label('birthdate', 'Birthdate: ') }}
    {{ Form::input('date', 'birthdate') }}
    {{ errorsFor('birthdate', $errors); }}
  </div>

  {{-- Phone Number --}}
  <div class="field-group">
    {{ Form::label('phone', 'Phone Number: ') }}
    {{ Form::text('phone') }}
    {{ errorsFor('phone', $errors); }}
  </div>

  {{-- Address Street --}}
  <div class="field-group">
    {{ Form::label('address_street', 'Address Street: ') }}
    {{ Form::text('address_street') }}
    {{ errorsFor('address_street', $errors); }}
  </div>

  {{-- Address Premise --}}
  <div class="field-group">
    {{ Form::label('address_premise', 'Apt, Suite or Floor: ') }}
    {{ Form::text('address_premise') }}
    {{ errorsFor('address_premise', $errors); }}
  </div>

  {{-- City --}}
  <div class="field-group -dual -alpha">
    {{ Form::label('city', 'City: ') }}
    {{ Form::text('city') }}
    {{ errorsFor('city', $errors); }}
  </div>

  {{-- State --}}
  <div class="field-group -dual -beta">
    {{ Form::label('state', 'State: ') }}
    {{ Form::select('state', $states); }}
    {{ errorsFor('state', $errors); }}
  </div>

  {{-- Zip --}}
  <div class="field-group">
    {{ Form::label('zip', 'Zip: ') }}
    {{ Form::text('zip') }}
    {{ errorsFor('zip', $errors); }}
  </div>

  {{-- Gender --}}
  <div class="field-group -mono">
    {{ Form::label('gender', 'Gender: ') }}
    {{ Form::select('gender', array('M' => 'Male', 'F' => 'Female')); }}
    {{ errorsFor('gender', $errors); }}
  </div>

 Of the following options, which best describes your race? (Check all that apply) (optional)
 @foreach($races as $key => $race)
 {{-- is this really how you make a new php variable? --}}
 {{-- */$matched = FALSE/* --}}
 @foreach($user->race as $fuckoff=>$whatev)
 <div class="field-group">
   {{ Form::label('race['. $key . ']', ' ') }}
   @if (isset($user->race[$fuckoff]) && $user->race[$fuckoff]->race == $race)
     {{ Form::checkbox('race['. $key . ']', $race, true) }}
       {{ $race }}
       {{-- */$matched = TRUE/* --}}
   @endif
 @endforeach
 @if(!$matched)
     {{ Form::checkbox('race['. $key . ']', $race) }}
   {{ $race }}
   @endif
 </div>
 @endforeach

  {{-- School --}}
  <div class="field-group">
    {{ Form::label('school', 'School: ') }}
    {{ Form::text('school') }}
    {{ errorsFor('school', $errors); }}
  </div>

  {{-- Grade --}}
  <div class="field-group -mono">
    {{ Form::label('grade', 'Grade: ') }}
    {{ Form::selectRange('grade', 9, 12); }}
    {{ errorsFor('grade', $errors); }}
  </div>
