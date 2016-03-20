$ = jQuery;

var freeSearch = $('#free-search');

var freeSearchForm = freeSearch.find('form');
var keyUpPress = 0;
var counter = 0;
var teachersList = [];


function afterAjax() {
  $( "#input-free-search" ).autocomplete({
    source: teachersList
  });
} afterAjax();


$(document).ready(function(){

  var data = {
    action: "free_search",
    freeSearchText: freeSearch.find('#input-free-search').val()
  }

  $.ajax({
    url : ajax_url,
    data : data,

    success : function(response) {
      counter ++;
        courseSearch.find("ul").empty();

        var responseLength = response.length;
        var html = "";
        var matchId = "";
        var matchTitle = "";
        var matchLink = "";
        var matchCity = "";
        var matchCourseName = "";
        var matchDay = "";
        var matchTime = "";
        var matchAge = "";
        var matchCourseTime = "";
        var matchSchool = "";
        var matchLevel = "";
        var matchOrganisation = "";
        var matchLogo = "";
        var matchStyles = "";
        var matchTeacher = "";
        var matchPrice = "";
        var matchOrgLink = "";

        function checkAndAdd(name) {
          var found = teachersList.some(function (el) {
            return el === name;
          });
          if (!found) { teachersList.push( name ); }
        }

        for(f = 0 ; f < responseLength ; f++) {
          if(response[f].teacher != null){
            checkAndAdd(response[f].teacher);
          }
          if(response[f].teacher != null){
            checkAndAdd(response[f].school);
          }
        }

        var response = response.filter(function (chain) {

            if(data.freeSearchText == chain.school || data.freeSearchText == chain.price || data.freeSearchText == chain.teacher || data.freeSearchText == chain.id  ){
              matchId = chain.id;
              matchTitle = chain.title;
              matchLink = chain.link;
              matchCity = chain.city;
              matchCourseName = chain.course_name;
              matchDay = chain.day;
              matchTime = chain.time;
              matchAge = chain.age;
              matchCourseTime = chain.course_time;
              matchSchool = chain.school;
              matchLevel = chain.level;
              matchOrganisation = chain.org;
              matchLogo = chain.logo;
              matchStyles = chain.styles;
              matchTeacher = chain.teacher;
              matchPrice = chain.price;
              matchStart = chain.start;
              matchHours = chain.hours;
              matchOrgLink = matchOrganisation[0].guid;

              writeHTML(matchId, matchTitle, matchLink, matchCity, matchCourseName, matchDay, matchTime, matchAge, matchCourseTime, matchSchool, matchLevel, matchOrganisation, matchLogo, matchStyles, matchTeacher, matchPrice, matchHours, matchStart   );
            }

        })

        afterAjax();



        courseSearch.find('ul').append(html);

    }, //success
    error: function( error ) {
      var errorMsg = "<h3>Sorry, something went wrong. Try again later or if the problem continues, please email me at malininc.s@gmail.com. Thank you!</h3>";
      $('.section-result').append(errorMsg);
    }
  })

})
