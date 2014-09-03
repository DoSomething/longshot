{{-- Company Name --}}
<div class="form-group">
  {{ Form::label('company_name', 'Company Name: ') }}
  {{ Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Acme, Inc.']) }}
  {{ errorsFor('company_name', $errors); }}
</div>

{{-- Company URL --}}
<div class="form-group">
  {{ Form::label('company_url', 'Company URL: ') }}
  {{ Form::text('company_url', null, ['class' => 'form-control', 'placeholder' => 'http://acme.com']) }}
  {{ errorsFor('company_url', $errors); }}
</div>

<hr>

{{-- Primary Color --}}
<div class="form-group">
  {{ Form::label('primary_color', 'Primary Color: ') }}
  <p><em class="text-muted">Primary branding color for buttons, links, etc.</em></p>
  <div class="input-group">
    <div class="input-group-addon">#</div>
    {{ Form::text('primary_color', null, ['class' => 'form-control', 'placeholder' => '6-digit hexadecimal color']) }}
  </div>
  {{ errorsFor('primary_color', $errors); }}
</div>

{{-- Primary Color Contrast --}}
<div class="form-group">
  {{ Form::label('primary_color_contrast', 'Primary Color Contrast: ') }}
  <div class="input-group">
    <div class="input-group-addon">#</div>
    {{ Form::text('primary_color_contrast', null, ['class' => 'form-control', 'placeholder' => '6-digit hexadecimal color']) }}
  </div>
  {{ errorsFor('primary_color_contrast', $errors); }}
</div>

{{-- Secondary Color --}}
<div class="form-group">
  {{ Form::label('secondary_color', 'Secondary Color: ') }}
  <div class="input-group">
    <div class="input-group-addon">#</div>
    {{ Form::text('secondary_color', null, ['class' => 'form-control', 'placeholder' => '6-digit hexadecimal color']) }}
  </div>
  {{ errorsFor('secondary_color', $errors); }}
</div>

{{-- Secondary Color Contrast --}}
<div class="form-group">
  {{ Form::label('secondary_color_contrast', 'Secondary Color Contrast: ') }}
  <div class="input-group">
    <div class="input-group-addon">#</div>
    {{ Form::text('secondary_color_contrast', null, ['class' => 'form-control', 'placeholder' => '6-digit hexadecimal color']) }}
  </div>
  {{ errorsFor('secondary_color_contrast', $errors); }}
</div>

{{-- Cap Color --}}
<div class="form-group">
  {{ Form::label('cap_color', 'Cap Color: ') }}
  <div class="input-group">
    <div class="input-group-addon">#</div>
    {{ Form::text('cap_color', null, ['class' => 'form-control', 'placeholder' => '6-digit hexadecimal color']) }}
  </div>
  {{ errorsFor('cap_color', $errors); }}
</div>

{{-- Cap Color Contrast --}}
<div class="form-group">
  {{ Form::label('cap_color_contrast', 'Cap Color Contrast: ') }}
  <div class="input-group">
    <div class="input-group-addon">#</div>
    {{ Form::text('cap_color_contrast', null, ['class' => 'form-control', 'placeholder' => '6-digit hexadecimal color']) }}
  </div>
  {{ errorsFor('cap_color_contrast', $errors); }}
</div>

<hr>

{{-- Header Logo --}}
<div class="form-group">
  {{ Form::label('header_logo', 'Header Logo: ') }}
  <div class="image-holder">
    <img src="/content/images/header-logo.png" alt="uploaded header logo">
  </div>
  {{ Form::file('header_logo') }}
  {{ errorsFor('header_logo', $errors); }}
</div>

{{-- Footer Logo --}}
<div class="form-group">
  {{ Form::label('footer_logo', 'Footer Logo: ') }}
  <div class="image-holder">
    <img src="/content/images/footer-logo.png" alt="uploaded footer logo">
  </div>
  {{ Form::file('footer_logo') }}
  {{ errorsFor('footer_logo', $errors); }}
</div>
