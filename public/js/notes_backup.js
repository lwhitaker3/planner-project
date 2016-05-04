function saveNote(form){

  $.post(form.attr('action'), form.serialize(), function(response){
    console.log(response);
  });
};



$('.note_text').on( 'input', function(){
  saveNote($(this));
});


autosize($('textarea'));


// initialize Packery
var $grid = $('.note_area').packery({
  itemSelector: '.sticky-note',
  columnWidth: '.grid-sizer',
  gutter: '.gutter-sizer',
  // columnWidth helps with drop positioning

});

$grid.on( 'input', '.sticky-note', function( event ) {
  // change size of item by toggling large class
  // trigger layout after item size changes
  $grid.packery('layout');
});

$grid.on( 'layoutComplete', orderItems );
//

function orderItems() {
  var itemElems = $grid.packery('getItemElements');
  $( itemElems ).each( function( i, itemElem ) {
    var formB = $(this).children(".note_text");
    // console.log(itemElem);
    if (formB.find('[name=order]').val() != i+1 ){
      formB.find('[name=order]').val(i+1)
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
  drag.on('dragEnd', orderItems);
});

// $('.note_text_area').mousedown(function(){
//   this.style.height="";
// });
