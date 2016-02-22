function App(){
	console.log("nurå");

$('#course-search').addClass('no-height');

$('#IRHolder').css('text-align', 'center');

$('#open').hide();
$('#result').hide();
$('#second-filter').hide();

 $('select').on('click', function(e){
	 e.preventDefault();
	 $('#course-search').addClass('height');
	 $('#open').fadeIn("slow");

 });

 $('#button-search').on('click', function(e){
	 $('#result').fadeIn("2000");
 });

 $('#button-second-filter').on('click', function(e){
	$('#second-filter').fadeIn("2000");
 });


/* Scroll events */

function scroll_style() {
   var window_top = $(window).scrollTop();
   var div_top = $('#course-search').offset().top;

   if (window_top > div_top-200){
		 		$('.header').addClass('grad');
      $('.header').css({"padding-top":"1.25em"});
      $('#click-menu').css({"top":"21px"});
   }
	 if (window_top < div_top-200){
			$('.header').removeClass('grad');
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
