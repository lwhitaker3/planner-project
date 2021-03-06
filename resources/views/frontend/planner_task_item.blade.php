<li class="task_list_item sortable">
  <span class="todo-wrap" id="planner_todo-wrap{{ $task->id }}" data-task-id="{{ $task->id }}">

    <form class="planner_todo_item todo_item" id="planner_todo_item{{ $task->id }}" action="/planner/task/{{ $task->id }}" method="POST">
      {{ csrf_field() }}
      <input class="planner_checkbox_item checkbox_item" name="completed" type="checkbox" id="planner_checkbox_item{{ $task->id }}" value=1 @if ($task->completed) checked @endif/>
      <label for="planner_checkbox_item{{ $task->id }}" class="todo">
        <i class="fa fa-check"></i>
        <span id="planner_todo_title{{ $task->id }}">{{ $task->title }}</span>
      </label>
      <input type="hidden" class="do_date" id="do_date{{ $task->id }}" name="do_date" value="{{$task->do_date}}">


      <!-- <input type="text" name="order" value="{{$task->order}}"> -->

      <!-- <span id="planner_todo_due{{ $task->id }}">
        @if ($task->due_date)
        {{ $task->due_date->format('m.d.Y')}}
        @endif
      </span> -->

    </form>

    <!-- <span class="delete-item" title="remove">
      <form action="/task/{{ $task->id }}" method="POST" id="planner_deleteTask{{ $task->id }}" data-task-id="{{ $task->id }}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}

          <button type="submit" id="planner_delete-task-{{ $task->id }}" class="close" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </form>
    </span> -->
  </span>
  <script>
    // $('#planner_deleteTask{{ $task->id }}').on( 'submit', deleteTaskListener);
    $('#planner_todo_item{{ $task->id }}').on( 'change input', function(){
      // if($('#planner_checkbox_item{{ $task->id }}').attr('checked')){
      //   console.log("yes");
      //   // console.log($(form).find('.planner_checkbox_item').attr('checked'));
      //   // console.log($(form).find('.planner_checkbox_item').parents('li'));
      //   // $($($(form).find('.planner_checkbox_item')).parents('li')).addClass('disabled_sort');
      // };
      updatePlannerTask($(this));
    });
    $('#planner_checkbox_item{{ $task->id }}').change(function(){
        var c = this.checked ? 'true' : 'false';
        if(c == 'true'){
          $(this).parents('li').addClass('disabled_sort');
          $($(this).parents('li')).disableSelection();
        } else {
          $(this).parents('li').removeClass('disabled_sort');
        }

    });





    // $("#planner_todo-wrap{{ $task->id }}").click(showEditForm);


  </script>
</li>
