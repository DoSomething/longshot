{{-- Title --}}
<div class="form-group">
  {{ Form::label('title', 'Page Title: ') }}
  {{ Form::text('title', null, ['class' => 'form-control']) }}
  {{ errorsFor('title', $errors); }}
</div>

{{-- URL --}}
<div class="form-group">

  {{ Form::label('url', 'URL: ') }}
  <div class="input-group">
      @if (isset($page))
        <div class="input-group-addon">{{ $page->path->url === '/' ? 'root' : '/' }}</div>
        {{ Form::text('url', $page->path->url, ['class' => 'form-control', 'disabled' => $page->path->disabled]) }}
      @else
        <div class="input-group-addon">/</div>
        {{ Form::text('url', null, ['class' => 'form-control']) }}
      @endif
    </div>
  {{ errorsFor('url', $errors); }}
</div>

{{-- Link Title --}}
<div class="form-group">

  {{ Form::label('link_text', 'Nav Link Text: ') }}
  @if (isset($page))
    {{ Form::text('link_text', $page->path->link_text, ['class' => 'form-control']) }}
  @else
    {{ Form::text('link_text', null, ['class' => 'form-control']) }}
  @endif
  {{ errorsFor('link_text', $errors); }}
</div>

  {{-- Description --}}
<div class="form-group">
  {{ Form::label('description', 'Description: ') }}
  {{ Form::textarea('description', null, ['class' => 'form-control']) }}
  {{ errorsFor('description', $errors); }}
</div>

   {{-- Hero Image --}}
<div class="form-group">
  {{ Form::label('hero_image', 'Hero Image: ') }}
  {{ Form::file('hero_image') }}
  {{ errorsFor('hero_image', $errors); }}
</div>

{{-- Block item grouping --}}
<div class="">
  @if (isset($blocks) && count($blocks) > 0)
    @foreach ($blocks as $key=>$block)

      <div class="well repeatable">
      {{ Form::hidden('blocks['.$key.'][id]', $blocks[$key]['id']) }}
      {{-- Block title --}}
      <div class="form-group">
        {{ Form::label('blocks['.$key.'][title]', 'Block Title: ') }}
        {{ Form::text('blocks['.$key.'][title]', $blocks[$key]['block_title'], ['class' => 'form-control']) }}
        {{ errorsFor('blocks['.$key.'][title]', $errors); }}
      </div>

      {{-- Block body --}}
      <div class="form-group">
        {{ Form::label('blocks['.$key.'][body]', 'Block Body: ') }}
        {{ Form::textarea('blocks['.$key.'][body]', $blocks[$key]['block_body'], ['class' => 'form-control']) }}
        {{ errorsFor('blocks['.$key.'][body]', $errors); }}
      </div>
      <button href="#" class ="btn remove"> Remove this block</button>

    </div>
   @endforeach

    @else
    <div class="well repeatable">

      {{-- Block title --}}
        <div class="form-group">
          {{ Form::label('blocks[0][title]', 'Block Title: ') }}
          {{ Form::text('blocks[0][title]', null, ['class' => 'form-control']) }}
          {{ errorsFor('blocks[0][title]', $errors); }}
        </div>

        {{-- Block body --}}
        <div class="form-group">
          {{ Form::label('blocks[0][body]', 'Block Body: ') }}
          {{ Form::textarea('blocks[0][body]', null, ['class' => 'form-control']) }}
          {{ errorsFor('blocks[0][body]', $errors); }}
        </div>
        <button href="#" class ="btn remove"> Remove this block</button>
      </div>

    @endif
  <div class="wrapper"></div>

  <hr>
  <button href="#" class ="btn clone"> + Add another block</button>
</div>



{{--@TODO: take this outta here. --}}
<script type="text/javascript">
  var cloneIndex = $(".repeatable").length - 1;
  var repeatableForm = $(".repeatable").first();
  $("button.clone").on("click", function(e){
      e.preventDefault();
      cloneIndex++;
      newClass = "cloned" + cloneIndex;
      newBlock = repeatableForm.clone()
                     .attr("class", newClass)
                     .appendTo(".wrapper");


      $.each($(".wrapper ." + newClass + " .form-group"), function() {
        inputFields = $(this).find(":input");
        // Replace all instances of [0] with cloneIndex
        newId = inputFields.attr("id").replace(0, cloneIndex);
        inputFields.attr('id', newId).attr('name', newId);
        $(this).find("label").attr("for", newId);
        // Remove the id from the cloned field if there.
        $(this).parents('.wrapper').find("input[type='hidden']").remove();
        // Do not copy the value over
        inputFields.val("");
      });
  });

  $(".well").on("click", "button.remove", function(e){
    e.preventDefault();
    $(this).parent().remove();
  });
</script>
