<footer role="contentinfo">
  <div class="wrapper">

    <div class="__partner">
      <span>In partnership with:</span> <img src="{{ $global_vars->footer_logo or '/dist/images/tmi-logo.png' }}" alt="partner">
    </div>

    <p class="__copyright">Copyright &copy; {{ date('Y') }} {{ $global_vars->company_name or 'TMI Agency' }}</p>

    <small class="__message">
      @if (! empty($global_vars->footer_text))
        {{ $global_vars->footer_text }}
      @endif
      Check out the <a href="{{ URL::to('https://s3.amazonaws.com/uploads.hipchat.com/34218/1222616/xWTSRkWcE7jrdAD/Foot%20Locker%20Scholar%20Athletes%20Official%20Rules%202014-2015.pdf') }}" target="_blank"><span>Official Rules</span></a>.
    </small>

  </div>
</footer>
