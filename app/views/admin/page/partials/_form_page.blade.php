

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
  {{-- @TODO: this needs to come out of the well, but I got the cloning working so here we are. --}}
  <button href="#" class ="btn clone"> Add another block</button>
  </div>



{{--@TODO: take this outta here. --}}
<script type="text/javascript">
  var regex = /^(.*)(\d)+$/i;
  var cloneIndex = $(".repeatable").length - 1;
  $("button.clone").on("click", function(e){
      e.preventDefault();
      newBlock = $(this).prev().clone()
                     .appendTo(".well")
                     .attr("class", "clone repeatable")
      cloneIndex++;
      // Replace all instances of [0] with cloneIndex
      $.each($(".clone .field-group :input"), function() {
        newId = $(this).attr("id").replace(cloneIndex-1, cloneIndex);
        $(this).attr( "id", newId)
               .attr("name", newId);
      });
  });

  $("button.remove").on("click", function(e){
    $(this).parent(".repeatable").remove();
  });
</script>
