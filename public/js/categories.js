function saveCategory(form){

  $.post(form.attr('action'), form.serialize(), function(response){
    $(".category_list").append(response.html);
    console.log(response);
    var object = JSON.parse(response.jsonCategory);
    console.log(object);
    form.trigger('categoryCreate', [object.id, object.name, object.color]);
  });
};

$('.create_category').on( 'submit', function(e){
  e.preventDefault();
  saveCategory($(this));
  // $('#category-name').val('');
});

function deleteListener(e){
  e.preventDefault();
  deleteCategory($(this));
}

function deleteCategory(form){
  $.post(form.attr('action'), form.serialize(), function(response){
    if(response.success){
      form.trigger('categoryDelete',[form.data('categoryId')]);
      form.parents('li').first().remove();
    }else{
      alert("This category is in use. You cannot delete!");
    }
  });
}

function editListener(e){
  e.preventDefault();
  editCategory($(this));
}

function triggerEvent(form, eventType){
  var name = form.find('.category_name').val();
  var color = form.find('.select_color').val();
  var id = form.data('categoryId');
  form.trigger(eventType, [id, name, color]);
}

function editCategory(form){

  $.post(form.attr('action'), form.serialize(), function(response){
    console.log(response);
    triggerEvent(form, 'categoryEdit');

  });
};
