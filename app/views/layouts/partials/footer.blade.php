<footer role="contentinfo">
  @if(isset($vars->footer_logo))
    <img src="{{ $vars->footer_logo }}" alt="partner">
  @endif
  <p>Copyright &copy; {{ date('Y') }} {{ $vars->company_name }}</p>
</footer>
