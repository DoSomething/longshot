<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li class="{{ setActive('settings', 3, 'active') }}">{{ link_to_route('settings', 'Overview') }}</li>
    <li class="{{ setActive('general', 3, 'active') }}">{{ link_to_route('general.edit', 'General') }}</li>
    <li class="{{ setActive('appearance', 3, 'active') }}">{{ link_to_route('appearance.edit', 'Appearance') }}</li>
    <li class="{{ setActive('scholarship', 3, 'active') }}">{{ link_to_route('admin.scholarship.index', 'Scholarship') }}</li>
  </ul>
</div>
