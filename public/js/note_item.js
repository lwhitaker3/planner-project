function deleteNoteListener(e){
  e.preventDefault();
  deleteNote($(this));
  console.log($(this));
}
//
function deleteNote(form){
  $.post(form.attr('action'), form.serialize(), function(response){
      form.trigger('noteDelete',[form.data('noteId')]);
      console.log(form.find('.sticky-note'));
      $grid.packery( 'remove', form.parents('.sticky-note')).packery('shiftLayout');
      // form.parents('.sticky-note').remove();
  });
}

function editNote(){
  $(this).find('.bulletColor').css('color', $(this).find(".category_select option:selected").data('categoryColor'));
  $(this).parents('.sticky-note').css('border-top', "4px "+$(this).find(".category_select option:selected").data('categoryColor')+" solid");
  updateNote($(this));
};

function updateNote(form){

  $.post(form.attr('action'), form.serialize(), function(response){
    console.log(response);
  });
};
