{{-- Recommendation --}}


      {{ Form::model($recommendation, ['method' => 'PATCH', 'route' => ['recommendation.update', $recommendation->id]]) }}

          {{-- Admin Update --}}
          <div class="field-group -dual -alpha">
            {{ Form::hidden('rec_id', $recommendation->id) }}
          </div>

          {{-- First Name --}}
          <div class="field-group -dual -alpha">
            {{ Form::label('first_name', 'Your First Name: ') }}
            {{ Form::text('first_name', $recommendation->first_name) }}
            {{ errorsFor('first_name', $errors); }}
          </div>

          {{-- Last Name --}}
          <div class="field-group -dual -beta">
            {{ Form::label('last_name', 'Your Last Name: ') }}
            {{ Form::text('last_name', $recommendation->last_name) }}
            {{ errorsFor('last_name', $errors); }}
          </div>

          {{-- Email --}}
          <div class="field-group -dual -alpha">
            {{ Form::label('email', 'Your Email: ') }}
            {{ Form::email('email', $recommendation->email) }}
            {{ errorsFor('email', $errors); }}
          </div>

          {{-- Phone Number --}}
          <div class="field-group -dual -beta">
            {{ Form::label('phone', 'Your Phone Number: ') }}
            {{ Form::text('phone') }}
            {{ errorsFor('phone', $errors); }}
          </div>

          {{-- Rank Character --}}
          <div class="field-group">
            {{ Form::label('rank_character', $label->rank_character) }}
            {{ Form::select('rank_character', $rank_values); }}
            {{ errorsFor('rank_character', $errors); }}
          </div>

          {{-- Rank Additional --}}
          <div class="field-group">
            {{ Form::label('rank_additional', $label->rank_additional) }}
            {{ Form::select('rank_additional', $rank_values); }}
            {{ errorsFor('rank_additional', $errors); }}
          </div>

          {{-- Essay 1 --}}
          <div class="field-group">
            {{ Form::label('essay1', $label->essay1) }}
            {{ Form::textarea('rec_essay1') }}
            {{ errorsFor('essay1', $errors); }}
          </div>

       {{ Form::submit('Update info', ['class' => 'btn btn-primary', 'name' => 'complete']) }}
      {{ Form::close() }}

  

 
