

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
    <div class="repeatable">

    {{-- Block title --}}
      <div class="field-group">
        {{ Form::label('blocks[0]["title"]', 'Block Title: ') }}
        {{ Form::text('blocks[0]["title"]') }}
        {{ errorsFor('blocks[0]["title"]', $errors); }}
      </div>

      {{-- Block desc --}}
      <div class="field-group">
        {{ Form::label('blocks[0]["description"]', 'Block Description: ') }}
        {{ Form::textarea('blocks[0]["description"]') }}
        {{ errorsFor('blocks[0]["description"]', $errors); }}
      </div>

      {{-- Block body --}}
      <div class="field-group">
        {{ Form::label('blocks[0]["body"]', 'Block Body: ') }}
        {{ Form::textarea('blocks[0]["body"]') }}
        {{ errorsFor('blocks[0]["body"]', $errors); }}
      </div>
      <button href="#" class ="btn remove"> Remove this block</button>
    </div>
    <div class="wrapper"></div>

  <button href="#" class ="btn clone"> Add another block</button>
  </div>



{{--@TODO: take this outta here. --}}
<script type="text/javascript">
  var cloneIndex = $(".repeatable").length - 1;
  var repeatableForm = $(".repeatable");
  $("button.clone").on("click", function(e){
      e.preventDefault();
      cloneIndex++;
      newClass = "cloned" + cloneIndex;
      newBlock = repeatableForm.clone()
                     .appendTo(".wrapper")
                     .attr("class", newClass);

      // Replace all instances of [0] with cloneIndex
      $.each($(".wrapper ." + newClass + " .field-group"), function() {
        inputFields = $(this).find(":input");
        newId = inputFields.attr("id").replace(0, cloneIndex);
        inputFields.attr('id', newId).attr('name', newId);
        $(this).find("label").attr("for", newId);

      });
  });

  $(".well").on("click", "button.remove", function(e){
    e.preventDefault();
    $(this).parent().remove();
  });
</script>
