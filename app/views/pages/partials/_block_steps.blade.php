{{-- Block Type: Steps --}}

<section class="segment segment--steps {{ $block->block_type === 'steps-vertical' ? '-vertical' : '-horizontal' }}">
  <h1 class="heading {{ $block->block_type === 'steps-vertical' ? '-alpha' : '-gamma' }}">
    {{ $block->block_title }}
  </h1>

  {{ $block->block_body_html }}

  @if($url === 'home')
    <div class="callout--scholarship">
      ${{ $scholarshipAmount }}
    </div>
  @endif
</section>
