

<li>

    <form id='category_name{{ $category->id }}' data-category-id="{{ $category->id }}" class="category_items" action="/category/{{ $category->id }}" method="POST">
      {{ csrf_field() }}
      <select name="color" class="select_color">
        <option value="#7bd148" @if ("#7bd148" == $category->color) selected @endif>Green</option>
        <option value="#5484ed" @if ("#5484ed" == $category->color) selected @endif>Bold blue</option>
        <option value="#a4bdfc" @if ("#a4bdfc" == $category->color) selected @endif>Blue</option>
        <option value="#46d6db" @if ("#46d6db" == $category->color) selected @endif>Turquoise</option>
        <option value="#7ae7bf" @if ("#7ae7bf" == $category->color) selected @endif>Light green</option>
        <option value="#51b749" @if ("#51b749" == $category->color) selected @endif>Bold green</option>
        <option value="#fbd75b" @if ("#fbd75b" == $category->color) selected @endif>Yellow</option>
        <option value="#ffb878" @if ("#ffb878" == $category->color) selected @endif>Orange</option>
        <option value="#ff887c" @if ("#ff887c" == $category->color) selected @endif >Red</option>
        <option value="#dc2127" @if ("#dc2127" == $category->color) selected @endif>Bold red</option>
        <option value="#dbadff" @if ("#dbadff" == $category->color) selected @endif>Purple</option>
        <option value="#e1e1e1" @if ("#e1e1e1" == $category->color) selected @endif>Gray</option>
      </select>

      <input type="text" name="name" value='{{ $category->name }}' class="category_name">

    </form>

    <!-- Task Delete Button -->
    <form action="/category/{{ $category->id }}" data-category-id="{{ $category->id }}" method="POST" id="deleteCategory{{ $category->id }}" class="deleteCategory">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <button type="submit" id="delete-task-{{ $category->id }}" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </form>

    <script src="{{ url('/js/jquery.simplecolorpicker.js') }}"></script>


    <script>
      $('#deleteCategory{{ $category->id }}').on( 'submit', deleteListener);

      $('#category_name{{ $category->id }}').on( 'input change', editListener);

      $('select[name="color"]').simplecolorpicker({picker:true});

    </script>
</li>
