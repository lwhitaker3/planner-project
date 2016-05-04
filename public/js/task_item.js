function deleteTaskListener(e){
  e.preventDefault();
  deleteTask($(this));
  // console.log($(this));
}

function deleteTask(form){
  $.post(form.attr('action'), form.serialize(), function(response){
      form.trigger('taskDelete',[form.data('taskId')]);
      form.parents('li').first().remove();
  });
}

function taskChanged(){
  var completed = this.checked;
  var wrap = $(this).parents('li');
  console.log(completed,wrap);
  wrap.addClass('fadeOut');
  // wrap.one('transitionend', completed, moveTask);
  window.setTimeout(moveTask, 1000, wrap, completed);
};
function moveTask(wrap, completed){
  console.log(arguments, wrap);
  $(wrap).remove();
  if (completed){
    $('#completed_list').append(wrap);
  } else {
    $('#sortable').append(wrap);
  }
  orderTasks();
  window.setTimeout(function(){
    $(wrap).removeClass('fadeOut');
  });
};

function showEditForm(){
  var isShown = false;
  var number = $(this).data('taskId');
  if ($("#todo_edit_wrap"+number).css('display') == "block"){
    isShown = true;
  }
  $(".todo_edit_wrap").css('display','none');
  if (!isShown){
    $("#todo_edit_wrap"+number).css('display','block');
  }
};

function saveReminder(form){

  $.post(form.attr('action'), form.serialize(), function(response){

    task = form.data('taskId');
    $("#reminder_list"+task).append(response.html);
    // console.log(form.data('taskId'));

    var object = JSON.parse(response.jsonCategory);
    // form.trigger('categoryCreate', [object.id, object.name, object.color]);
  });
};

function reminderSaveListener(e){
  e.preventDefault();
  saveReminder($(this));
  // $('#category-name').val('');
};

function editTodo(){
  $(this).find('.bulletColor').css('color', $(this).find(".category_select option:selected").data('categoryColor'));
  saveTask($(this));
};

function updateDate(form){
  var task = form.data('taskId');
  var date = $('#date_picker_input'+task).val().toString();
  var dateFormat = date.replace(/\//g, ".")
  $('#todo_due'+task).html(dateFormat);
}

function updateListText(){
  var task = $(this).data('taskId');
  $('#todo_title'+task).html($(this).val());
};
