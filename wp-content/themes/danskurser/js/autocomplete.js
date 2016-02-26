// $ = jQuery;
//
// console.log("körs");
//
// var freeSearch = $('#free-search');
//
// var freeSearchForm = freeSearch.find('form');
//
// var teachersList = [];
// var newTeachersList = [];
//
// function afterAjax() {
//   $( "#input-free-search" ).autocomplete({
//     source: teachersList
//   });
// } afterAjax();
//
// $(document).ready(function(){
//
//   var data = {
//     action: "free_search"
//   }
//
//   $.ajax({
//     url : ajax_url,
//     data : data,
//     success : function(response) {
//
//         var responseLength = response.length;
//         console.log(responseLength)
//
//         var list = jQuery.inArray(newTeachersList, teachersList);
//         if (list >= 0) {
//             // Element was found, remove it.
//             teachersList.splice(list, 1);
//         } else {
//             // Element was not found, add it.
//             teachersList.push(newTeachersList);
//         }
//         afterAjax();
//
//     }, //success
//     error: function( error ) {
//       alert("Something went wrong, maybe you have lost your connection to internet.");
//     }
//
//
//
//   })
// })
