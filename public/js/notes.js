function saveNote(form){

  $.post(form.attr('action'), form.serialize(), function(response){
    console.log(response);
  });
};


// $('.note_text').on( 'input', function(){
//   $(this).find('.bulletColor').css('color', $(this).find(".category_select option:selected").data('categoryColor'));
//   saveNote($(this));
//   console.log(this);
// });






Packery.prototype.initShiftLayout = function() {
  this._resetLayout();
  var packery = this;
  this.items = $(this.options.itemSelector).map(function(i, itemElem){
    var item = packery.getItem(itemElem);
    return item;
  }).toArray();
  // console.log(this.items);
  // set item order and horizontal position from saved positions
  // this.items = positions.map( function( itemPosition ) {
  //   var selector = '[' + attr + '="' + itemPosition.attr  + '"]'
  //   var itemElem = this.element.querySelector( selector );
  //   var item = this.getItem( itemElem );
  //   item.rect.x = itemPosition.x * this.packer.width;
  //   return item;
  // }, this );
  this.shiftLayout();
  this.items.map(function(item){
    item.rect.x = $(item.element).find('[name=xpos]').val() * (item.rect.width);
    return item;
  });
  this.shiftLayout();
};


// initialize Packery
var $grid = $('.note_area').packery({
  itemSelector: '.sticky-note',
  columnWidth: '.grid-sizer',
  gutter: '.gutter-sizer',
  initLayout: false // disable initial layout
  // columnWidth helps with drop positioning

});


// init layout with saved positions
$grid.packery( 'initShiftLayout');


$grid.on( 'input', '.sticky-note', function( event ) {
  // change size of item by toggling large class
  // trigger layout after item size changes
  // console.log('layout input');
  $grid.packery('shiftLayout');
  orderItems();
});




$grid.on( 'layoutComplete', orderItems );
//


function orderItems() {
  // console.log($grid.data('packery'));
  var items= $grid.data('packery').items;
  $( items ).each( function( i, item ) {
    var formB = $(this.element).children(".note_text");
    // console.log(itemElem);
    var edited = false;
    if (formB.find('[name=order]').val() != i+1 ){
      formB.find('[name=order]').val(i+1)
      edited = true;
    }
    var xpos = Math.round((item.rect.x/$grid.data('packery').packer.width) *3);
    // console.log(xpos,formB.find('[name=xpos]'));
    if (formB.find('[name=xpos]').val() != xpos ){
      formB.find('[name=xpos]').val(xpos);
      edited = true;
    }

    if(edited){
      saveNote(formB);
    }

  });

}


// make all grid-items draggable
$grid.find('.sticky-note').each( function( i, gridItem ) {
  var drag = new Draggabilly( gridItem, {
    handle: '.drag-section'
  });
  // bind drag events to Packery
  $grid.packery( 'bindDraggabillyEvents', drag );
  // drag.on('dragEnd', orderItems);
});

function updateDrag(note){
  // make all grid-items draggable
    var drag = new Draggabilly( note, {
      handle: '.drag-section'
    });
    // bind drag events to Packery
    $grid.packery( 'bindDraggabillyEvents', drag );
    // drag.on('dragEnd', orderItems);
};



$(".category_list").on("categoryEdit", function(e, id, name, color){

  $('.sticky-note .category_select option[value='+id+']').each(function(i,item){
    $(item).text(name);
    $(item).data('categoryColor', color);
  });
  $('.note_text').each(function(i,form){
    $(form).find('.bulletColor').css('color', $(form).find(".category_select option:selected").data('categoryColor'));
  });
  $('.sticky-note').each(function(i,form){
    console.log(this);
    $(this).css('border-top', "4px "+ $(form).find(".category_select option:selected").data('categoryColor')+" solid");
  });
});

$(".category_list").on("categoryDelete", function(e, id){
  $('.sticky-note .category_select option[value='+id+']').each(function(i,item){
    $(item).remove();
  });
});

$(".create_category").on("categoryCreate", function(e, id, name, color){
  console.log(id,name);
  $('.category_select').append($('<option>', {
    'data-category-color': color,
    value: id,
    text: name
  }));
});

$('.create_note').on( 'submit', function(e){
  e.preventDefault();
  createTask($(this));
  // $('#category-name').val('');
});
function createTask(form){
  $.post(form.attr('action'), form.serialize(), function(response){
    var item = $(response.note_item);
    $('#note_list').prepend(item);
    $grid.packery( 'prepended', item);
    updateDrag(item.get(0));
  });
};
