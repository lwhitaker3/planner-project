function saveTask(form){

  $.post(form.attr('action'), form.serialize(), function(response){
    console.log(response);
  });
};



autosize($('.task_info'));


// $('.todo').click(function(e) {
//   e.preventDefault();
// });
// console.log($('.todo_edit'));

$(".category_list").on("categoryEdit", function(e, id, name, color){

  $('.todo_edit .task_category_select option[value='+id+']').each(function(i,item){
    $(item).text(name);
    $(item).data('categoryColor', color);
  });
  $('.todo_edit').each(function(i,form){
    $(form).find('.bulletColor').css('color', $(form).find(".task_category_select option:selected").data('categoryColor'));
  });
});

$(".category_list").on("categoryDelete", function(e, id){
  $('.todo_edit .task_category_select option[value='+id+']').each(function(i,item){
    $(item).remove();
  });
});

$(".create_category").on("categoryCreate", function(e, id, name, color){
  // console.log(id,name);
  $('.task_category_select').append($('<option>', {
    'data-category-color': color,
    value: id,
    text: name
  }));
});






// function saveTask(form){
//
//   $.post(form.attr('action'), form.serialize(), function(response){
//     console.log(response);
//   });
// };
$('.create_task').on( 'submit', function(e){
  e.preventDefault();
  createTask($(this));
  // $('#category-name').val('');
});


function createTask(form){
  $.post(form.attr('action'), form.serialize(), function(response){
    $("#sortable").prepend(response.list_item);
    $("#edit-section").append(response.edit_section);
    // console.log(response.list_item);
    orderTasks();
  });
};

function orderTasks() {
  // console.log($grid.data('packery'));
  var items= $('.task_list_item');
  $( items ).each( function( i, item ) {
    var form = $(item).find(".todo_item");
    console.log(form);
    if (form.find('[name=order]').val() != i+1 ){
      form.find('[name=order]').val(i+1)
      saveTask(form);
    }
  });

}
