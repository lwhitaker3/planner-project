

<li>


    <form action="/reminder/{{ $reminder->id }}" data-reminder-id="{{ $reminder->id }}" method="POST" id="deleteReminder{{ $reminder->id }}" class="deleteReminder">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <button type="submit" id="delete-reminder-{{ $reminder->id }}" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </form>

    <form action="/reminder/{{ $reminder->id }}" data-reminder-id="{{ $reminder->id }}" method="POST" id="editReminder{{ $reminder->id }}" class="editReminder">
      {{ csrf_field() }}
      <input type=text name=text class="form-control" value='{{ $reminder->text }}'>

      <div class="form-group">
          <div class='input-group date daypicker_reminder' id="daypicker_reminder{{ $reminder->id }}">
              <input name="reminder_time" type='text' class="form-control" value= '{{ $reminder->reminder_time->format("m-d-Y")}}'/>
              <span class="input-group-addon">
                <img class="add_icons" src="{{ url('/images/icon-09.png') }}">
              </span>
          </div>
      </div>
    </form>

    <script>
      $('#deleteReminder{{ $reminder->id }}').on( 'submit', deleteReminderListener);
      $('#editReminder{{ $reminder->id }}').on( 'change input', function(){
        updateReminder($(this));
      });
      $(function () {
          var daypicker = $('#daypicker_reminder{{ $reminder->id }}').datetimepicker({
            format: 'L'
          });
          daypicker.on("dp.change", function(e) {
              var form = $(this).parents('.editReminder');
              // console.log($(this).find('input').val());
              // var date = new Date($(this).find('input').val());
              // // var year = (date.getFullYear()).toString();
              // // var month = (date.getMonth()+1).toString();
              // // var day = (date.getDate()).toString();
              // // var hour = (date.getHours()).toString();
              // // var min = (date.getMinutes()).toString();
              // // // var sec = "00";
              // // var timestamp = year + "-" + month + "-" + day  + " " + hour + ":" + min + ":" + sec;
              // var timestamp = '2015-02-11 08:12:49';
              // $(this).find('input').val(timestamp);
              // console.log($(this).find('input').val())
              saveTask(form);

           });
      });
    </script>



</li>
