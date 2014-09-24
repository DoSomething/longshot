{{-- Block Type: Default --}}

<section class="segment">
  @if(isset($block->block_title))
    <h1 class="heading -gamma">{{ $block->block_title }}</h1>
  @endif
  {{ $block->block_body_html }}
</section>
