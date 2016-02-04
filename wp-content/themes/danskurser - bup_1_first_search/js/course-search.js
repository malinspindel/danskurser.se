$ = jQuery;

var courseSearch = $('#course-search');

var searchForm = courseSearch.find('form');

console.log(searchForm);

searchForm.submit(function(e){
  e.preventDefault();

  var level_one = 0;
  if(courseSearch.find('#level_1').prop("checked"))
    level_one = 1;

  var data = {
    action : "course_search",
    day: courseSearch.find('#day').val(),
    time: courseSearch.find('#time').val(),
    level_1: level_one

  }

  $.ajax({
    url : ajax_url,
    data : data,
    success : function(response) {

      courseSearch.find("ul").empty();

      for(var i = 0; i < response.length; i++) {
        console.log(response[i]);

        var html = "<li id='course-id-" + response[i].id + "'><a href ='" + response[i].permalink + "'>" + response[i].title + "</a></li>";
        courseSearch.find('ul').append(html);
      }

      console.log(response);
    }
  });
});
