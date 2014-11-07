<footer role="contentinfo">
  <div class="wrapper">

    <div class="__partner">
      <span>In partnership with:</span> <img src="{{ $global_vars->footer_logo or '/dist/images/tmi-logo.png' }}" alt="partner">
    </div>

    <p class="__copyright">Copyright &copy; {{ date('Y') }} {{ $global_vars->company_name or 'TMI Agency' }}</p>

    <p class="__message">
      <small>
        @if (!empty($global_vars->footer_text))
          {{ $global_vars->footer_text }}
        @endif

        @if (isset($global_vars->official_rules_url))
          Check out the {{ link_to($global_vars->official_rules_url, 'Official Rules', ['target' => '_blank']) }}.
        @endif
      </small>
    </p>

  </div>
</footer>
