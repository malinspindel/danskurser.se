function App(){

	//Prevent error when pressing enter in Freesearch input
	$(document).ready(function() {
	  $(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
	  });
	});

	//Popup only shown once / user
	$("#popup-info").hide();
	// $("#popup-info").delay(3000).fadeIn();

	var storage = localStorage.getItem('popState') != 'shown';
	//don't work now (on local)
  // if(storage){
	// 	console.log("kör coookie");
  //     $("#popup-info").delay(3000).fadeIn();
  //     localStorage.setItem('popState','shown')
  // }
	//
  // $('.popup-close').click(function(e) // You are clicking the close button
  // {
  //     $('#popup-info').fadeOut(); // Now the pop up is hiden.
  // });
	//
  // $('#popup-info').click(function(e)
  // {
  //     $('#popup-info').fadeOut();
  // });


//hide elements
$('#loadMore').hide();

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

//Show on Scroll
    /* Every time the window is scrolled ... */


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
	//scroll to result
	$('html, body').animate({
        scrollTop: $("#result").offset().top - 60
    }, 1000);


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
	//scroll to result
	$('#result').fadeIn("2000");
		$('html, body').animate({
        scrollTop: $("#result").offset().top - 60
    }, 1000);
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




   if (window_top > 100){
	  $('.header').addClass('background-blue');
      $('.header').css({"padding-top":"1.1em","padding-bottom":"1.1em"});
      $('.header .logo img').css({"width":"43%"});
      $('#click-menu').css({"top":"18px"});
   }
	 if (window_top < 100){
			$('.header').removeClass('background-blue');
			$('.header').css({"padding-top":"1.75em"});
			$('.header .logo img').css({"width":"52%"});
			$('#click-menu').css({"top":"24px"});

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
