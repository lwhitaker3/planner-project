

@include('common.errors')

<h3>Categories</h3>

<!-- New Note Form -->
<form action="/category" method="POST" class="create_category form-inline">
    {{ csrf_field() }}

    <!-- Note Text -->
    <div class="form-group">
      <div class="input-group">
        <label for="category-name" class="sr-only">Category</label>
        <input type="text" name="name" id="category-name" class="form-control" value="{{ old('category') }}" placeholder="Add New Category">
        <input type="hidden" name="color" value="#7bd148">
        <div class="input-group-btn">
          <button type="submit" class="plus-button btn btn-default">
            <img class="add_icons" src="{{ url('/images/icon-05.png') }}">
          </button>
        </div>
      </div>
    </div>

    <!-- Add Note Button -->

</form>

<!-- Current Notes -->

<script type="text/javascript" src="{{ url('/js/categories.js') }}"></script>

<div class="row">
  <ul class="category_list">
    @each ("frontend.category_item", $categories, "category")

  </ul>
</div>
