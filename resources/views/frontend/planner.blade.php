@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">


    <div class="col-sm-3 planner-list">
			<h5>Unnassigned Tasks</h5>

      @include('common.errors')

      <form class="create_task" action="/planner" method="POST" class="form-inline">
        {{ csrf_field() }}

              <!-- Task Text -->
        <div class="form-group">
          <label for="task-title" class="sr-only">Task</label>
          <input type="text" name="title" id="task-title" class="form-control" value="{{ old('task') }}" placeholder="Add New Task">
        </div>


              <!-- Add Task Button -->
        <button type="submit" class="btn btn-default">
          <img class="add_icons" src="{{ url('/images/add_note-05.png') }}">
        </button>
      </form>

			<ul id="initial_list" class="sortable-list" data-date="null">
        @foreach ($tasks as $task)
          @if (!$task->completed)
            @if (!$task->do_date)
                @include('frontend/planner_task_item')

            @endif
          @endif
        @endforeach
			</ul>
		</div>


		<div class="col-sm-9">
      <form action="/planner" method="GET">
        <input type="hidden" value="{{$daysOffset-4}}" name="offset">
        <button type="submit">Previous</button>
      </form>

      <form action="/planner" method="GET">
        <input type="hidden" value="{{$daysOffset+4}}" name="offset">
        <button type="submit">Next</button>
      </form>
      @for($row = 0; $row < $numDays/4; $row++)
        <div class="row day-row">
          @for($i = $row*4; $i < 4+(4*$row); $i++)
    				<div class="col-sm-3 day-wrapper" data-date="{{$startDate->copy()->addDay($i)}}">
    					<h4 id="day{{$i}}">{{$startDate->copy()->addDay($i)->format('D n/j')}}</h4>
    					<div class="day-container">
    						<ul class="sortable-list" data-date="{{$startDate->copy()->addDay($i)}}">
                  @foreach ($tasks as $task)
                    @if (!$task->completed)
                      @if ($task->do_date)
                        @if ($task->do_date->eq($startDate->copy()->addDay($i)))
                          <li class="sortable-item">
                            @include('frontend/planner_task_item')
                            <!-- <form action = "/planner/task/{{$task->id}}" method="POST">
                              {{ csrf_field() }}
                              &#9679; {{ $task->title }}
                              <input type="hidden" class="do_date" id="do_date{{ $task->id }}" name="do_date" value="{{$task->do_date}}">
                            </form> -->
                          </li>
                        @endif
                      @endif
                    @endif
                  @endforeach
    						</ul>
                <hr>
                <form class="daily_note" id="daily_note{{$i}}" action = "/daily_note" method="POST">
                  {{ csrf_field() }}
                  <textarea name="text" class="form-control">@foreach($daily_notes as $daily_note){{($daily_note->day->eq($startDate->copy()->addDay($i)))?$daily_note->text:""}}@endforeach</textarea>
                  <input type='text' name="day" value="{{$startDate->copy()->addDay($i)}}">
                </form>
                <script>
                $('#daily_note{{$i}}').on( 'change', function(){
                  updatePlannerTask($(this));
                });
                </script>
                @foreach($tasks as $task)
                  @if($task->due_date)
                    @if($task->due_date->eq($startDate->copy()->addDay($i)))
                      <p>
                        {{$task->title}} is due
                      </p>
                    @endif
                  @endif
                @endforeach
                @foreach($reminders as $reminder)
                  @if($reminder->reminder_time)
                    @if($reminder->task)
                      @if($reminder->reminder_time->eq($startDate->copy()->addDay($i)))
                        <p>
                          Reminder: {{$reminder->text}} </br>
                          For Task: {{$reminder->task->title}}
                        </p>
                      @endif
                    @endif
                  @endif
                @endforeach
    					</div>
    				</div>
          @endfor
        </div>
      @endfor
		</div>




	</div>

</div>
<script type="text/javascript" src="{{ url('/js/planner.js') }}"></script>


<script type="text/javascript">


  $(document).ready(function(){

    // Example 1.3: Sortable and connectable lists with visual helper
    $('.sortable-list').sortable({
      connectWith: '.sortable-list',
      placeholder: 'placeholder',
      items: 'li'
    });
  $( ".sortable-list" ).on( "sortreceive", function(e, ui) {
    var value = $(this).data('date');
    var item = ui.item;
    console.log(item.find('.do_date'));
    item.find('.do_date').val(value);
    form = ui.item.find('form');
    console.log(form);
    updatePlannerTask(form);
  } );


});

</script>


@endsection
