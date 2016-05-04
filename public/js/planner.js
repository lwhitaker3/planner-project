// function editPlannerTask(){
//   updatePlannerTask($(this));
//   console.log(this);
// };

function updatePlannerTask(form){
  // $('.planner_checkbox_item').each(function(i){
  //   if($(this).attr('checked')){
  //     ($(this).parents('li').addClass('disabled_sort'));
  //   }else{
  //     ($(this).parents('li').removeClass('disabled_sort'));
  //   }
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
