<footer role="contentinfo">
  <div class="wrapper">

    <div class="__partner">
      <span>In partnership with:</span> <img src="{{ $global_vars->footer_logo or '/dist/images/tmi-logo.png' }}" alt="partner">
    </div>

    <nav class="alternative-nav">
      <ul class="__menu -level-1">
        <li><a href="/about"><span>About</span></a></li>
        <li><a href="/faq"><span>FAQs</span></a></li>
        <li><a href="{{ URL::to('https://s3.amazonaws.com/uploads.hipchat.com/34218/1222616/xWTSRkWcE7jrdAD/Foot%20Locker%20Scholar%20Athletes%20Official%20Rules%202014-2015.pdf') }}" target="_blank"><span>Official Rules</span></a></li>
      </ul>
    </nav>

    <p class="__copyright">Copyright &copy; {{ date('Y') }} {{ $global_vars->company_name or 'TMI Agency' }}</p>

    @if (! empty($vars->footer_text))
      <small class="__message">{{ $vars->footer_text }}</small>
    @endif

  </div>
</footer>
