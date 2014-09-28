{{-- Block Type: Call To Action --}}

<section class="segment segment--cta">
  <h1 class="heading -alpha">{{ $block->block_title }}</h1>

  <div class="wrapper">
    {{ $block->block_body_html }}

    @if (Auth::guest())
      <div class="fragment">
        {{ link_to_route('registration.create', 'Start Application', null, ['class' => 'button -default']) }}
        {{ link_to_route('status', 'or continue an application') }}
      </div>
    @else
      <div class="fragment">
        {{ link_to_route('status', 'Continue Application', null, ['class' => 'button -default']) }}
      </div>
    @endif
  </div>
</section>
