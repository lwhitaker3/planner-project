<div class='todo_edit_wrap' id='todo_edit_wrap{{ $task->id }}'>

  <form class="todo_edit" action="/taskedit/{{ $task->id }}" method="POST" id="todo_edit{{ $task->id }}" data-task-id="{{ $task->id }}">
    {{ csrf_field() }}
    <h4>Task Details</h4>
    <input name="title" type="text" class="form-control todo_edit_text" id="todo_edit_text{{ $task->id }}" data-task-id="{{ $task->id }}" value="{{ $task->title }}"/>
    <div class="form-group">
        <div class='input-group date daypicker' id="date_picker{{ $task->id }}">
            <input name="due_date" type='text' class="form-control" id="date_picker_input{{ $task->id }}" @if ($task->due_date) value="{{ $task->due_date->format('m.d.Y')}}"@endif/>
            <span class="input-group-addon">
              <img class="add_icons" src="{{ url('/images/icon-09.png') }}">
            </span>
        </div>
        <!-- <div class='input-group date timepicker' id="time_picker{{ $task->id }}">
            <input name="due_time" type='text' class="form-control" value= '{{ $task->due_time }}'/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
        </div> -->
    </div>
    <textarea rows="1" type="text" maxlength="255" name="text" id="task_info{{$task->id}}" class="task_info form-control" placeholder="Add Description...">{{ $task->text }}</textarea>
    <span id="bulletColor{{ $task->id }}" class="bulletColor">&#8226;</span>
    <select id="task_category_select{{ $task->id }}" class="task_category_select form-control" name="category_id">
      <option data-category-color="gray" value="">None</option>
      @foreach ($categories as $category)
      <option data-category-color="{{ $category->color }}" value="{{ $category->id }}" @if ($task->category_id == $category->id) selected @endif>{{ $category->name }}</option>
      @endforeach
    </select>
  </form>

  <form action="/reminder" method="POST" data-task-id="{{$task->id}}" id="create_reminder{{$task->id}}" class="create_reminder form-horizontal">
      {!! csrf_field() !!}

      <!-- Task Name -->
      <!-- <div class="form-group">
          <label for="task-name" class="col-sm-3 control-label">Reminder</label>

          <div class="col-sm-6">
              <input type="text" name="text" id="task-name" class="form-control">
          </div>
      </div> -->

      <input type="hidden" name="task_id" value='{{ $task->id }}'>





      <!-- Add Task Button -->
      <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-default">
              <img class="add_icons" src="{{ url('/images/icon-06.png') }}">
              <img class="add_icons" src="{{ url('/images/icon-08.png') }}">
            </button>
          </div>
      </div>
  </form>

  <ul id="reminder_list{{$task->id  }}" class="reminder_list" data-task-id='{{ $task->id }}'>
    @foreach($reminders as $reminder)
      @if($reminder->task_id == $task->id)
        @include('frontend.reminder_item')
      @endif
    @endforeach

  </ul>
  <script>
    autosize($('#task_info{{$task->id}}'));
    $('#create_reminder{{$task->id}}').on( 'submit', reminderSaveListener);
    $('#todo_edit{{ $task->id }}').on( 'change input', editTodo);
    $('#bulletColor{{ $task->id }}').css('color', $("#task_category_select{{ $task->id }} option:selected").data('categoryColor'));
    $('#todo_edit_text{{ $task->id }}').on('input', updateListText);


    $(function () {
        var daypicker = $('#date_picker{{ $task->id }}').datetimepicker({
          format: 'L'
        });

        daypicker.on("dp.change", function(e) {
            var form = $(this).parents('.todo_edit');
            updateDate(form);
            saveTask(form);

         });
    });
  </script>
</div>
