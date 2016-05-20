{{-- Block Type: Detailed List --}}

<section {!! output_id($block->block_title) !!} class="segment segment--detailed-list">
  <div class="wrapper">

    @if (!empty($block->block_title))
      <h1 class="heading -gamma visually-hidden">{!! $block->block_title !!}</h1>
    @endif

    @if (!empty($block->block_body_html))
      {!! $block->block_body_html !!}
    @endif

  </div>
</section>
