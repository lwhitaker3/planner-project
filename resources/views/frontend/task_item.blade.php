<li class="task_list_item">
  <span class="todo-wrap" id="todo-wrap{{ $task->id }}" data-task-id="{{ $task->id }}">

    <form class="todo_item" id="todo_item{{ $task->id }}" action="/task/{{ $task->id }}" method="POST">
      {{ csrf_field() }}
      <input class="checkbox_item" name="completed" type="checkbox" id="checkbox_item{{ $task->id }}" value=1 @if ($task->completed) checked @endif/>
      <label for="checkbox_item{{ $task->id }}" class="todo">
        <i class="fa fa-check"></i>
        <span id="todo_title{{ $task->id }}">{{ $task->title }}</span>
      </label>

      <input type="hidden" name="order" value="{{$task->order}}">

      <span class="todo_due" id="todo_due{{ $task->id }}">
        @if ($task->due_date)
        {{ $task->due_date->format('m.d.Y')}}
        @endif
      </span>

    </form>

    <span class="delete-item" title="remove">
      <form action="/task/{{ $task->id }}" method="POST" id="deleteTask{{ $task->id }}" data-task-id="{{ $task->id }}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}

          <button type="submit" id="delete-task-{{ $task->id }}" class="close" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </form>
    </span>
  </span>
  <script>
    $('#deleteTask{{ $task->id }}').on( 'submit', deleteTaskListener);
    $('#todo_item{{ $task->id }}').on( 'change input', function(){
      saveTask($(this));
    });
    $('#checkbox_item{{ $task->id }}').on('change', taskChanged);
    $("#todo-wrap{{ $task->id }}").click(showEditForm);


  </script>
</li>
