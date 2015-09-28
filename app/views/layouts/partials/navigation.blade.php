<nav id="main-nav" class="main-nav panel panel--nav" role="navigation">
  <h1 class="visually-hidden">Main Navigation</h1>
  <ul class="__menu -level-1">
      <?php //@TODO: Need to grab the static pages from the DB instead of hardcoding. ?>
      <li class="{{ setActive('/') }}"><a href="/"><span>Home</span></a></li>
      <li class="{{ setActive('about') }}"><a href="/about"><span>About</span></a></li>
      <li class="{{ setActive('faq') }}"><a href="/faq"><span>FAQs</span></a></li>

      @if (Auth::guest())
         <li class="{{ setActive('login') }}"><a href="/login"><span>Log in</span></a></li>
        @if (!Scholarship::isClosed() && Scholarship::isOpen())
          <li class="{{ setActive('register') }}"><a href="/register"><span>Apply</span></a></li>
        @endif
      @else
        <li class="{{ setActive('status') }}"><a href="/status"><span>Status</span></a></li>
        <li><a href="/logout"><span>Log out</span></a></li>
      @endif
  </ul>
</nav>
