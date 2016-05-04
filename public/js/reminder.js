function deleteReminderListener(e){
  e.preventDefault();
  deleteReminder($(this));
  // console.log($(this));
}

function deleteReminder(form){
  $.post(form.attr('action'), form.serialize(), function(response){
      form.trigger('reminderDelete',[form.data('reminderId')]);
      form.parents('li').first().remove();
  });
}
function updateReminder(form){

  $.post(form.attr('action'), form.serialize(), function(response){
    console.log(response);
  });
};
