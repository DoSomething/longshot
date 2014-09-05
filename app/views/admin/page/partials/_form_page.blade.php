<script type="text/javascript">
$("button.clone")
var regex = /^(.*)(\d)+$/i;
var cloneIndex = $(".repeatable").length;
$("button.clone").click(function(e){
    e.preventDefault();
    $(this).parents(".repeatable").clone()
        .appendTo("body")
        .attr("id", "repeatable" +  cloneIndex)
        .find("*").each(function() {
            var id = this.id || "";
            var match = id.match(regex) || [];
            if (match.length == 3) {
                this.id = match[1] + (cloneIndex);
            }
    });
    cloneIndex++;
});

$("button.remove").click(function(e){
  e.preventDefault();
  $(this).parents(".repeatable").remove();
});
</script>

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
  <div class="repeatable well">

  {{-- Block title --}}
    <div class="field-group">
      {{ Form::label('block_title[0]', 'Block Title: ') }}
      {{ Form::text('block_title[0]') }}
      {{ errorsFor('block_title[0]', $errors); }}
    </div>

    {{-- Block desc --}}
    <div class="field-group">
      {{ Form::label('block_description[0]', 'Block Description: ') }}
      {{ Form::textarea('block_description[0]') }}
      {{ errorsFor('block_description[0]', $errors); }}
    </div>

    {{-- Block body --}}
    <div class="field-group">
      {{ Form::label('block_body[0]', 'Block Body: ') }}
      {{ Form::textarea('block_body[0]') }}
      {{ errorsFor('block_body[0]', $errors); }}
    </div>

    <button href="#" class ="btn clone"> Add another block</button>
    <button href="#" class ="btn remove"> Remove this block</button>
  </div>
