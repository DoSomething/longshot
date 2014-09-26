{{-- Block Type: Steps --}}

<section class="segment segment--steps {{ $block->block_type === 'steps-vertical' ? '-vertical' : '-horizontal' }}">

  @if($url === 'home')

    <h1 class="__title heading -alpha">{{ $block->block_title }}</h1>

    <div class="wrapper">
      {{ $block->block_body_html }}

      <aside class="callout callout--scholarship">
        ${{ $scholarshipAmount }}
      </aside>
    </div>

  @else

    <div class="wrapper">
      <h1 class="__title heading {{ $block->block_type === 'steps-vertical' ? '-alpha' : '-gamma' }}">{{ $block->block_title }}</h1>

      {{ $block->block_body_html }}
    </div>

  @endif

</section>
