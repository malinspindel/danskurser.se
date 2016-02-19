(function ($, root, undefined) {

	$(function () {

		'use strict';

		// DOM ready, take it away

	});

})(jQuery, this);

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

}

//
// $('#pickCity').on('click', function(e) {
// 	 	e.preventDefault();
// 	 	$('.tt-wrapper').show();
// 	 	$('.picker-wrapper').hide();
// 	 	$('.input-large-white').focus();
// 	 });




jQuery(document).ready(function(){

	var app = new App();

});
