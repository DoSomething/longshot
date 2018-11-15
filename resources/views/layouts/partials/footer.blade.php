<footer role="contentinfo">
  <div class="wrapper">

    <div class="__partner">
      <span>In partnership with:</span> <img src="{{ asset_url($global_vars->footer_logo, '/dist/images/tmi-logo.png') }}" alt="partner">
    </div>

    <p class="__copyright">Copyright &copy; {{ date('Y') }} {{ $global_vars->company_name or 'DoSomething Strategic' }}</p>

    @if (isset($global_vars->footer_text) || isset($global_vars->official_rules_url))
    <p class="__message">
      <small>
        {!! $global_vars->footer_text or '' !!}

        @if (isset($global_vars->official_rules_url))
          Check out the {{ link_to($global_vars->official_rules_url, 'Official Rules', ['target' => '_blank']) }}.
        @endif
      </small>
    </p>
    @endif

  </div>
</footer>
