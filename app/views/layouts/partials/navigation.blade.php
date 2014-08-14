<nav id="main-nav" class="main-nav">
  <h1>Main Navigation</h1>
  <ul>
      <li><a href="/">Home</a></li>
      <li><a href="/about">About</a></li>
      <li><a href="/faq">FAQs</a></li>

      @if (Auth::guest())
        <li><a href="/register">Apply</a></li>
        <li><a href="/login">Login</a></li>
      @else
        <li><a href="/application">Application</a></li>
        <li><a href="/recommendation">Recommendation</a></li>
        <li><a href="/status">Status</a></li>
        <li><a href="/logout">Logout</a></li>
      @endif
  </ul>
</nav>
