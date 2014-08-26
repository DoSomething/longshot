{{-- Company Name --}}
<div class="form-group">
  {{ Form::label('company_name', 'Company Name: ') }}
  {{ Form::text('company_name', null, ['class' => 'form-control']) }}
  {{ errorsFor('company_name', $errors); }}
</div>

{{-- Company URL --}}
<div class="form-group">
  {{ Form::label('company_url', 'Company URL: ') }}
  {{ Form::text('company_url', null, ['class' => 'form-control']) }}
  {{ errorsFor('company_url', $errors); }}
</div>

{{-- Primary Color --}}
<div class="form-group">
  {{ Form::label('primary_color', 'Primary Color: ') }}
  <div class="input-group">
    <div class="input-group-addon">#</div>
    {{ Form::text('primary_color', null, ['class' => 'form-control']) }}
  </div>
  {{ errorsFor('primary_color', $errors); }}
</div>

{{-- Secondary Color --}}
<div class="form-group">
  {{ Form::label('secondary_color', 'Secondary Color: ') }}
  <div class="input-group">
    <div class="input-group-addon">#</div>
    {{ Form::text('secondary_color', null, ['class' => 'form-control']) }}
  </div>
  {{ errorsFor('secondary_color', $errors); }}
</div>

{{-- Button Color --}}
<div class="form-group">
  {{ Form::label('button_color', 'Button Color: ') }}
  <div class="input-group">
    <div class="input-group-addon">#</div>
    {{ Form::text('button_color', null, ['class' => 'form-control']) }}
  </div>
  {{ errorsFor('button_color', $errors); }}
</div>

{{-- Link Color --}}
<div class="form-group">
  {{ Form::label('link_color', 'Link Color: ') }}
  <div class="input-group">
    <div class="input-group-addon">#</div>
    {{ Form::text('link_color', null, ['class' => 'form-control']) }}
  </div>
  {{ errorsFor('link_color', $errors); }}
</div>

{{-- Header Logo --}}
<div class="form-group">
  {{ Form::label('header_logo', 'Header Logo: ') }}
  {{ Form::file('header_logo') }}
  {{ errorsFor('header_logo', $errors); }}
</div>

{{-- Footer Logo --}}
<div class="form-group">
  {{ Form::label('footer_logo', 'Footer Logo: ') }}
  {{ Form::file('footer_logo') }}
  {{ errorsFor('footer_logo', $errors); }}
</div>
