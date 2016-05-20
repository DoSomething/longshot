{{-- Block Type: Call To Action --}}

<section {!! output_id($block->block_title) !!} class="segment segment--cta">

  @if (!empty($block->block_title))
    <h1 class="heading -alpha">{!! $block->block_title !!}</h1>
  @endif

  <div class="wrapper">
    @if (!empty($block->block_body_html))
      {!! $block->block_body_html !!}
    @endif
    @if($url === 'home' && !$scholarship->isClosed() && $scholarship->isOpen())
      <div class="fragment">
        @if (Auth::guest())
          {!! link_to_route('registration.create', 'Start Application', null, ['class' => 'button -default']) !!}
          {!! link_to_route('status', 'or continue an application') !!}
        @else
          {!! link_to_route('status', 'Continue Application', null, ['class' => 'button -default']) !!}
        @endif
      </div>
    @endif

  </div>
</section>
