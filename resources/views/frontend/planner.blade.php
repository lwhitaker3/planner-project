@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">


    <div class="col-sm-3 planner-list">
      <!-- <div class="fixed"> -->
  			<h3>Unassigned Tasks</h3>

        @include('common.errors')

        <form class="create_task" action="/planner" method="POST" class="form-inline">
          {{ csrf_field() }}


                <!-- Task Text -->
          <div class="form-group">
            <div class="input-group">
              <label for="task-title" class="sr-only">Task</label>
              <input type="text" name="title" id="task-title" class="form-control" value="{{ old('task') }}" placeholder="Add New Task">
              <div class="input-group-btn">
                <button type="submit" class="button_group_custom btn btn-default">
                  <img class="add_icons" src="{{ url('/images/icon-02.png') }}">
                </button>
              </div>
            </div>
          </div>
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
      <!-- </div> -->
		</div>


		<div class="col-sm-9 border_left">
      <form action="/planner" method="GET" class="arrow_buttons" id="left_button">
        <input type="hidden" value="{{$daysOffset-4}}" name="offset">
        <button type="submit">
          <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
          Back
        </button>
      </form>

      <form action="/planner" method="GET" class="arrow_buttons" id="right_button">
        <input type="hidden" value="{{$daysOffset+4}}" name="offset">
        <button type="submit">
          Next
          <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
        </button>
      </form>
      @for($row = 0; $row < $numDays/4; $row++)
        <div class="row day-row">
          @for($i = $row*4; $i < 4+(4*$row); $i++)
    				<div class="col-sm-3 day-wrapper" data-date="{{$startDate->copy()->addDay($i)}}">
    					<h4 id="day{{$i}}">{{$startDate->copy()->addDay($i)->format('D n/j')}}</h4>
    					<div class="day-container">
                <div class="inner_wrapper">
      						<ul class="sortable-list" data-date="{{$startDate->copy()->addDay($i)}}">
                    @foreach ($tasks as $task)
                      @if ($task->do_date)
                        @if ($task->do_date->eq($startDate->copy()->addDay($i)))
                            @include('frontend/planner_task_item')
                            <!-- <form action = "/planner/task/{{$task->id}}" method="POST">
                              {{ csrf_field() }}
                              &#9679; {{ $task->title }}
                              <input type="hidden" class="do_date" id="do_date{{ $task->id }}" name="do_date" value="{{$task->do_date}}">
                            </form> -->
                        @endif
                      @endif
                    @endforeach
      						</ul>
                  <hr>
                  <form class="daily_note" id="daily_note{{$i}}" action = "/daily_note" method="POST">
                    {{ csrf_field() }}
                    <textarea name="text" class="form-control daily_note_text">@foreach($daily_notes as $daily_note){{($daily_note->day->eq($startDate->copy()->addDay($i)))?$daily_note->text:""}}@endforeach</textarea>
                    <input type='hidden' name="day" value="{{$startDate->copy()->addDay($i)}}">
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
                        {{$task->title}} <span class="due"> is due</span>
                      </p>
                      @endif
                    @endif
                  @endforeach
                  @foreach($reminders as $reminder)
                    @if($reminder->reminder_time)
                      @if($reminder->task)
                        @if($reminder->reminder_time->eq($startDate->copy()->addDay($i)))
                        <p>
                          <span class="reminder">Reminder: </span>{{$reminder->text}} </br>
                          For Task: {{$reminder->task->title}}
                        </p>
                        @endif
                      @endif
                    @endif
                  @endforeach
      					</div>
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

  autosize($('textarea'));


  $(document).ready(function(){
    $('.planner_checkbox_item').each(function(i){
      if($(this).attr('checked')){
        ($(this).parents('li').addClass('disabled_sort'));
      }
    })

    // Example 1.3: Sortable and connectable lists with visual helper
    $('.sortable-list').sortable({
      connectWith: '.sortable-list',
      placeholder: 'placeholder',
      items: 'li',
      cancel: '.disabled_sort',
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



    var height;
    var tallest = 0;
    $('.inner_wrapper').each(function( index ) {
      height = $(this).outerHeight();
      if (height > tallest){
        tallest = height;
      }
    });
    console.log(tallest);
    $('.day-container').each(function( index ) {
      $(this).css("height", tallest);
    });

});

</script>


@endsection
