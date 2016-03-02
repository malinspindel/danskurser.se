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



//show and hide elements
$('#course-search').addClass('no-height');


$('#IRHolder').css('text-align', 'center');

$('#open').hide();
$('#result').hide();
$('#second-filter').hide();
$('#free-search').hide();


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
	 $('#free-search').slideToggle("1000");
 });

 $('#free-search').on('click', function(e){
	//  $('#course-search').removeClass('no-height');
	//  $('#open').fadeOut("slow");
	$('#open').addClass('shadow-effect');
	$('#result').fadeIn("2000");
 })


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
