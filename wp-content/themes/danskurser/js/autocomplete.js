$ = jQuery;

var freeSearch = $('#free-search');

var freeSearchForm = freeSearch.find('form');
var keyUpPress = 0;
var counter = 0;
var teachersList = [];
//peka på teacher i den här arrayen

function afterAjax() {
  $( "#input-free-search" ).autocomplete({
    source: teachersList
  });
} afterAjax();

// var requestSent = false;



$(document).ready(function(){


  var data = {
    action: "free_search",
    freeSearchText: freeSearch.find('#input-free-search').val()
  }

  // if(!requestSent) {
    // requestSent = true;


  $.ajax({
    url : ajax_url,
    data : data,
    // complete: function() {
    //   requestSent = false;
    // },
    success : function(response) {
      counter ++;
      // console.log(counter);
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
        // console.log(response);

        function checkAndAdd(name) {
          // var id = teachersList.length + 1;
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
          // console.log(chain.id);
          // console.log(data.freeSearchText);
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

              // console.log(matchOrgLink);

              writeHTML(matchId, matchTitle, matchLink, matchCity, matchCourseName, matchDay, matchTime, matchAge, matchCourseTime, matchSchool, matchLevel, matchOrganisation, matchLogo, matchStyles, matchTeacher, matchPrice, matchHours, matchStart   );
              // console.log("school match!");
              // return matchTitle + matchLink + matchCity + matchCourseName + matchDay + matchTime + matchAge + matchCourseTime + matchSchool + matchLevel + matchOrganisation + matchLogo + matchStyles + matchTeacher;

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
