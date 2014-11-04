{{-- Block Type: Timeline --}}

<section {{ output_id($block->block_title) }} class="segment segment--timeline">
  <div class="wrapper">

    @if (!empty($block->block_title))
      <h1 class="heading -gamma">{{ $block->block_title }}</h1>
    @endif

    @if (!empty($block->block_body_html))
      {{ $block->block_body_html }}
    @endif

  </div>
</section>
