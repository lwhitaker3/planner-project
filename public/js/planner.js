// function editPlannerTask(){
//   updatePlannerTask($(this));
//   console.log(this);
// };

function updatePlannerTask(form){

  $.post(form.attr('action'), form.serialize(), function(response){
    console.log(response);
  });
};

$('.create_task').on( 'submit', function(e){
  e.preventDefault();
  createTask($(this));
  // $('#category-name').val('');
});


function createTask(form){
  $.post(form.attr('action'), form.serialize(), function(response){
    $("#initial_list").append(response.list_item);
  });
};
