function App(){
	console.log("nurå");

	//Prevent error when pressing enter in Freesearch input
	$(document).ready(function() {
	  $(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
	  });
	});



//hide elements
$('#course-search').addClass('no-height');


$('#IRHolder').css('text-align', 'center');

$('#open').hide();
$('#result').hide();
$('#second-filter').hide();
$('#free-search').hide();

//click event to select2 plugin
function format(state) {
    if (!state.id) return state.text; // optgroup
    return state.text + " <i class='info'>link</i>";
}

var select2 = $("#city").select2({
    formatResult: format,
    formatSelection: format,
    escapeMarkup: function(m) { return m; }
}).data('select2');

//toggle elements
 $('select').on('click', function(e){
	 e.preventDefault();
	 $('#course-search').addClass('height');
	 $('#open').removeClass('shadow-effect');
	 $('#open').fadeIn("slow");
 });

 $('#open').on('click', function(e){
 	$('#open').removeClass('shadow-effect');
 });

 $('#button-search').on('click', function(e){
	 $('#result').fadeIn("2000");
 });


 $('#button-second-filter').on('click', function(e){
	$('#second-filter').slideToggle("1000");
 });

 $('.free-search-icon').on('click', function(e) {
	 $('#free-search').fadeToggle("1000");
 });

 $('#free-search').on('click', function(e){
	 $('#course-search').removeClass('no-height');
	//  $('#open').fadeOut("slow");
	$('#open').addClass('shadow-effect');
	$('#result').fadeIn("2000");
});


// Toggle - +
$('#button-second-filter').on('click', function(e){
	if($( "#button-second-filter i" ).hasClass( "fa-plus-square-o")){
		$( "#button-second-filter i" ).switchClass( "fa-plus-square-o", "fa-minus-square-o", 500);
	} else {
		$( "#button-second-filter i" ).switchClass( "fa-minus-square-o", "fa-plus-square-o", 500);
	}
});


/* Scroll events */

function scroll_style() {
   var window_top = $(window).scrollTop();
   var div_top = $('#course-search').offset().top;

   if (window_top > div_top-200){
		 	$('.header').addClass('background-blue');
      $('.header').css({"padding-top":"1.25em"});
      $('#click-menu').css({"top":"21px"});
   }
	 if (window_top < div_top-200){
			$('.header').removeClass('background-blue');
			$('.header').css({"padding-top":"2.9em"});
			$('#click-menu').css({"top":"38px"});

	 }
}
$(function() {
  $(window).scroll(scroll_style);
  scroll_style();
 });



}






jQuery(document).ready(function(){

	var app = new App();

});
