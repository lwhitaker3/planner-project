<div class="sticky-note" id="sticky-note{{ $note->id }}">
  <div class="drag-section"></div>
  <form id="deleteNote{{ $note->id }}" action="/note/{{ $note->id }}" method="POST" data-note-id="{{ $note->id }}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <button type="submit" id="delete-note-{{ $note->id }}" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </form>
  <form data-note-id="{{ $note->id }}" class="note_text" id="note_text{{ $note->id }}" action="/note/{{ $note->id }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" value="{{ $note->order }}" name="order">
    <input type="hidden" value="{{ $note->xpos }}" name="xpos">
    <textarea id="title{{ $note->id }}" rows="1" type="text" maxlength="255" name="title" class="note_title form-control" placeholder="Add Title...">{{ $note->title }}</textarea>
    <textarea id="textarea{{ $note->id }}" maxlength="255" name="text" class="form-control note_text_area" placeholder="Type New Note...">{{ $note->text }}</textarea>

    <div class="category_select_wrapper">
      <span id="bulletColor{{ $note->id }}" class="bulletColor">&#8226;</span>
      <!-- {{ $note->category['color'] }} -->

      <select id="category_select{{ $note->id }}" class="category_select" name="category_id">
        <option data-category-color="gray" value="">None</option>
        @foreach ($categories as $category)
        <option data-category-color="{{ $category->color }}" value="{{ $category->id }}" @if ($note->category_id == $category->id) selected @endif>{{ $category->name }}</option>
        @endforeach
      </select>
    </div>
  </form>
  <p>
    @if ($note->created_at)
      Created on: {{ $note->created_at->format('m-d-Y') }}
    @else
      Created on:
    @endif
  </p>
  <script>
  $('#deleteNote{{ $note->id }}').on( 'submit', deleteNoteListener);
  $('#bulletColor{{ $note->id }}').css('color', $("#category_select{{ $note->id }} option:selected").data('categoryColor'));
  $('#sticky-note{{ $note->id }}').css('border-top', "4px "+$("#category_select{{ $note->id }} option:selected").data('categoryColor')+" solid");
  $('#note_text{{ $note->id }}').on( 'input', editNote);
  autosize($('#textarea{{ $note->id }}'));
  autosize($('#title{{ $note->id }}'));




  </script>
</div>
