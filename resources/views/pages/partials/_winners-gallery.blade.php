@if ($winners)
  <section id="winners-gallery" class="segment segment--gallery" data-modal="">
    <div class="wrapper">
      <h1 class="__title heading -alpha">{!! $winner_scholarship_period !!} Class</h1>

      <ul class="gallery" data-ui="modal" data-modal-type="slideshow">
      @foreach ($winners as $key => $winner)
        <li data-slide='{{ $key+1 }}'>
          <div class="wrapper">
          <article class="card" data-modal="trigger" data-slideshow="content">
            <div class="wrapper">
              <h1 class="heading -delta __title">{!! $winner->first_name . ' ' . $winner->last_name !!}</h1>
              <ul class="media-list media-list--key-value __info">
                <li><strong>Location:</strong> {!! $winner->city . ', ' . $winner->state !!} </li>
                <li><strong>Sports(s):</strong> {!! $winner->participation !!}</li>
                <li><strong>GPA:</strong> {!! $winner->gpa !!}</li>
                <li><strong>College:</strong> {!! $winner->college !!} </li>
              </ul>
            </div>
            <figure>
              <img src="{{ $winner->photo }}" alt="Image of scholarship winner {{ $winner->first_name . ' ' . $winner->last_name }}">
              <figcaption>{!! $winner->first_name !!}</figcaption>
            </figure>
            <div class="__body"> {!! $winner->description !!} </div>
          </article>
        </div>
        </li>
      @endforeach
      </ul>

    </div>
  </section>
@endif
