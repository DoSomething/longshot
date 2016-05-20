{{-- Block Type: Default --}}

<section class="segment">

  @if (!empty($block->block_title))
    <h1 class="heading -gamma">{!! $block->block_title !!}</h1>
  @endif

  @if (!empty($block->block_body_html))
    {!! $block->block_body_html !!}
  @endif

</section>
