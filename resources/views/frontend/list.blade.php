@extends('layouts.app')

@section('content')

<script type="text/javascript" src="{{ url('/js/task_item.js') }}"></script>

<div class="container">
  <div class="row">
    <div class="col-sm-12">

      <div class="col-sm-2">
        <div class="fixed">
          @include('frontend.category')
        </div>
      </div>

      <div class="col-sm-8 border_right border_left">
        <div class="row form_row">

          @include('common.errors')

          <form action="/task" method="POST" class="create_task form-inline">
            {{ csrf_field() }}

                  <!-- Task Text -->
            <div class="form-group">
              <label for="task-title" class="sr-only">Task</label>
              <input type="text" name="title" id="task-title" class="form-control" value="{{ old('task') }}" placeholder="Add New Task">
            </div>

                  <!-- Add Task Button -->
            <button type="submit" class="btn btn-default">
              <img class="add_icons" src="{{ url('/images/icon-06.png') }}">
              <img class="add_icons" src="{{ url('/images/icon-03.png') }}">
            </button>
          </form>

        </div>



        <div class="row">

          <div class="col-sm-6" id="todo-list">
            <div class="todo_tasks">
              <h2>CURRENT TASKS</h2>
              <ul id="sortable">
              @foreach ($tasks as $task)

                @if (!$task->completed)

                    @include('frontend.task_item')

                @endif

              @endforeach
              </ul>
            </div>

            <h4>COMPLETED</h4>
            <div class="completed_tasks">
              <ul id="completed_list">

                @foreach ($tasks as $task)
                  @if ($task->completed)
                    @include('frontend.task_item')
                  @endif

                @endforeach
              <ul>
            </div>
          </div>

          <script type="text/javascript" src="{{ url('/js/reminder.js') }}"></script>
          <div class="col-sm-6" id="edit-section">
            <div class="col-sm-3 fixed">
              @foreach ($tasks as $task)
                @include('frontend.task_item_edit')
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-2">
        <div class="fixed">
          @include('frontend.news_feed')
        </div>
      </div>

    </div>
  </div>


</div>


<script type="text/javascript" src="{{ url('/js/list.js') }}"></script>

<script>
  $(function() {
    $( "#sortable" ).sortable({
      placeholder: 'placeholder',
      update: orderTasks,
    });
    $( "#sortable" ).disableSelection();
  });
</script>







@endsection
