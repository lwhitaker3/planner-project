<h3>Daily Feed</h3>

<ul id="dailyFeedList">
@for($i = 0; $i < 5; $i++)
  <li data-date="{{$newsFeedDate->copy()->addDay($i)}}">
    <h4 id="day{{$i}}">{{$newsFeedDate->copy()->addDay($i)->format('D n/j')}}</h4>
    @foreach($daily_notes as $daily_note)
      @if($daily_note->day->eq($newsFeedDate->copy()->addDay($i)))
        <p>
          <span class="daily">Notes: </span>{{$daily_note->text}}
        </p>
      @endif
    @endforeach
    @foreach($tasks as $task)
      @if($task->due_date)
        @if($task->due_date->eq($newsFeedDate->copy()->addDay($i)))
          <p>
            {{$task->title}} <span class="due"> is due</span>
          </p>
        @endif
      @endif
      @if($task->do_date)
        @if($task->do_date->eq($newsFeedDate->copy()->addDay($i)))
          <p>
            <span class="work_on">Work on </span>{{$task->title}}
          </p>
        @endif
      @endif
    @endforeach
    @foreach($reminders as $reminder)
      @if($reminder->reminder_time)
        @if($reminder->task)
          @if($reminder->reminder_time->eq($newsFeedDate->copy()->addDay($i)))
            <p>
              <span class="reminder">Reminder: </span>{{$reminder->text}} </br>
              For Task: {{$reminder->task->title}}
            </p>
          @endif
        @endif
      @endif
    @endforeach

  </li>
@endfor
</ul>

<ul>



</ul>
