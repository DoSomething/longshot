<nav id="main-nav" class="main-nav" role="navigation">
  <h1 class="visually-hidden">Main Navigation</h1>
  <ul class="__menu -level-1">
      <li><a href="/"><span>Home</span></a></li>
      <li><a href="/about"><span>About</span></a></li>
      <li><a href="/faq"><span>FAQs</span></a></li>

      @if (Auth::guest())
        <li><a href="/register"><span>Apply</span></a></li>
        <li><a href="/login"><span>Login</span></a></li>
      @else
        <li><a href="/status"><span>Status</span></a></li>
        <li>{{ link_to_profile() }}</li>
        <li><a href="/logout"><span>Logout</span></a></li>
      @endif
  </ul>
</nav>
