// $ = jQuery;
//
// var courseSearch = $('#course-search');
//
// var searchForm = courseSearch.find('form');
//
// console.log(searchForm);
//
// searchForm.submit(function(e){
//   e.preventDefault();
//
//   var data = {
//     action : "course_search",
//     city: courseSearch.find('#city').val(),
//     level: courseSearch.find('#level').val()
//   }
//
//   $.ajax({
//     url : ajax_url,
//     data : data,
//     success : function(response) {
//
//       courseSearch.find("ul").empty();
//
//       for(var i = 0; i < response.length; i++) {
//         console.log(response[i]);
//
//         var city = response[i].city;
//         var level = response[i].level;
//
//         if(data.level == "level_1"){
//
//           if(level == "level_1" || level == "level_2" ) {
//             var html = "<li>" + level + "</li>";
//           }
//         }
//         courseSearch.find('ul').append(html);
//       }
//
//       console.log(response);
//     },
//     error: function( error ) {
//       var errorMsg = "<h3>Sorry, something went wrong. Try again later or if the problem continues, please email me at malininc.s@gmail.com. Thank you!</h3>";
//       $('.section-result').append(errorMsg);
//     }
//   });
// });
