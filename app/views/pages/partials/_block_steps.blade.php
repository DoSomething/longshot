{{-- Block Type: Steps --}}

<section {{ output_id($block->block_title) }} class="segment segment--steps {{ $block->block_type === 'steps-vertical' ? '-vertical' : '-horizontal' }}">

  @if($url === 'home')

    @if (!empty($block->block_title))
      <h1 class="heading -alpha">{{ $block->block_title }}</h1>
    @endif

    <div class="wrapper">
      @if (!empty($block->block_body_html))
        {{ $block->block_body_html }}
      @endif

      @if (isset($scholarshipAmount))
        <aside class="callout callout--scholarship">
          <div class="wrapper">
            <strong><span class="__amount">${{ useMetricPrefix($scholarshipAmount) }}</span> Scholarship</strong>
          </div>
        </aside>
      @endif
    </div>

  @else

    <div class="wrapper">
      @if (!empty($block->block_title))
        <h1 class="heading {{ $block->block_type === 'steps-vertical' ? '-alpha' : '-gamma' }}">{{ $block->block_title }}</h1>
      @endif

      @if (!empty($block->block_body_html))
        {{ $block->block_body_html }}
      @endif
    </div>

  @endif

</section>
