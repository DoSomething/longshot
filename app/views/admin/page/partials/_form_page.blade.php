

  {{-- Title --}}
  <div class="field-group">
    {{ Form::label('title', 'Title: ') }}
    {{ Form::text('title') }}
    {{ errorsFor('title', $errors); }}
  </div>

    {{-- Description --}}
  <div class="field-group">
    {{ Form::label('description', 'Description: ') }}
    {{ Form::textarea('description') }}
    {{ errorsFor('description', $errors); }}
  </div>

     {{-- Hero Image --}}
  <div class="field-group">
    {{ Form::label('hero_image', 'Hero Image: ') }}
    {{ Form::file('hero_image') }}
    {{ errorsFor('hero_image', $errors); }}
  </div>

  {{-- Block item grouping --}}
  <div class="well">
    @if (isset($blocks))
      @foreach ($blocks as $key=>$block)

        <div class="repeatable">
        {{Form::hidden('blocks['.$key.'][id]', $blocks[$key]['id'])}}
        {{-- Block title --}}
        <div class="field-group">
          {{ Form::label('blocks['.$key.'][title]', 'Block Title: ') }}
          {{ Form::text('blocks['.$key.'][title]', $blocks[$key]['block_title']) }}
          {{ errorsFor('blocks['.$key.'][title]', $errors); }}
        </div>

        {{-- Block desc --}}
        <div class="field-group">
          {{ Form::label('blocks['.$key.'][description]', 'Block Description: ') }}
          {{ Form::textarea('blocks['.$key.'][description]', $blocks[$key]['block_description']) }}
          {{ errorsFor('blocks['.$key.'][description]', $errors); }}
        </div>

        {{-- Block body --}}
        <div class="field-group">
          {{ Form::label('blocks['.$key.'][body]', 'Block Body: ') }}
          {{ Form::textarea('blocks['.$key.'][body]', $blocks[$key]['block_body']) }}
          {{ errorsFor('blocks['.$key.'][body]', $errors); }}
        </div>
        <button href="#" class ="btn remove"> Remove this block</button>

      </div>
     @endforeach

      @else
      <div class="repeatable">

        {{-- Block title --}}
          <div class="field-group">
            {{ Form::label('blocks[0][title]', 'Block Title: ') }}
            {{ Form::text('blocks[0][title]') }}
            {{ errorsFor('blocks[0][title]', $errors); }}
          </div>

          {{-- Block desc --}}
          <div class="field-group">
            {{ Form::label('blocks[0][description]', 'Block Description: ') }}
            {{ Form::textarea('blocks[0][description]') }}
            {{ errorsFor('blocks[0][description]', $errors); }}
          </div>

          {{-- Block body --}}
          <div class="field-group">
            {{ Form::label('blocks[0][body]', 'Block Body: ') }}
            {{ Form::textarea('blocks[0][body]') }}
            {{ errorsFor('blocks[0][body]', $errors); }}
          </div>
          <button href="#" class ="btn remove"> Remove this block</button>
        </div>

      @endif
    <div class="wrapper"></div>


  <button href="#" class ="btn clone"> Add another block</button>
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

      // If set, remove hidden id of the block id
      $("input[type='hidden']").remove();

      $.each($(".wrapper ." + newClass + " .field-group"), function() {
        inputFields = $(this).find(":input");
        // Replace all instances of [0] with cloneIndex
        newId = inputFields.attr("id").replace(0, cloneIndex);
        inputFields.attr('id', newId).attr('name', newId);
        $(this).find("label").attr("for", newId);
        // Do not copy the value over
        inputFields.val("");
      });
  });

  $(".well").on("click", "button.remove", function(e){
    e.preventDefault();
    $(this).parent().remove();
  });
</script>
