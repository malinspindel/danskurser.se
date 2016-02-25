$ = jQuery;

var freeSearch = $('#free-search');

var freeSearchForm = freeSearch.find('form');

var teachersList = [];
//peka på teacher i den här arrayen




function afterAjax() {
  $( "#input-free-search" ).autocomplete({
    source: teachersList
  });
} afterAjax();

var requestSent = false;


freeSearchForm.keyup(function(e){

  courseSearch.find('ul').empty();

  var data = {
    action: "free_search",
    freeSearchText: freeSearch.find('#input-free-search').val()
  }

  if(!requestSent) {
    requestSent=true;


  $.ajax({
    url : ajax_url,
    data : data,

    complete: function() {
      requestSent = false;
    },
    success : function(response) {

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
        console.log(response);

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
              matchDay = chain.day_mon;
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

              //Dag
        if(matchDay == "day_mon"){
          matchDay = "Mån";
        }
        if(matchDay == "day_tue"){
          matchDay = "Tis";
        }
        if(matchDay == "day_wed"){
          matchDay = "Ons";
        }
        if(matchDay == "day_thu"){
          matchDay = "Tor";
        }
        if(matchDay == "day_fri"){
          matchDay = "Fre";
        }
        if(matchDay == "day_sat"){
          matchDay = "Lör";
        }
        if(matchDay == "day_sun"){
          matchDay = "Sön";
        }

        //Ålder
        if(matchAge == "age_1"){
          matchAge = "1-3 år";
        }
        if(matchAge == "age_4"){
          matchAge = "4-6 år";
        }
        if(matchAge == "age_7"){
          matchAge = "7-9 år";
        }
        if(matchAge == "age_10"){
          matchAge = "10-12 år";
        }
        if(matchAge == "age_13"){
          matchAge = "13-15 år";
        }
        if(matchAge == "age_16"){
          matchAge = "16+";
        }
        if(matchAge == "age_30"){
          matchAge = "30+";
        }
        if(matchAge == "age_50"){
          matchAge = "50+";
        }

        //Nivå
        if(matchLevel == "1"){
          matchLevel = "N";
        }
        if(matchLevel == "2"){
          matchLevel = "N-F";
        }
        if(matchLevel == "3"){
          matchLevel = "F";
        }
        if(matchLevel == "4"){
          matchLevel = "F-M";
        }
        if(matchLevel == "5"){
          matchLevel = "M";
        }
        if(matchLevel == "6"){
          matchLevel = "M-A";
        }
        if(matchLevel == "7"){
          matchLevel = "A";
        }
        if(matchLevel == "8"){
          matchLevel = "P";
        }
        if(matchLevel == "9"){
          matchLevel = "ALLA";
        }

              writeHTML(matchId, matchTitle, matchLink, matchCity, matchCourseName, matchDay, matchTime, matchAge, matchCourseTime, matchSchool, matchLevel, matchOrganisation, matchLogo, matchStyles, matchTeacher, matchPrice   );
              // console.log("school match!");
              // return matchTitle + matchLink + matchCity + matchCourseName + matchDay + matchTime + matchAge + matchCourseTime + matchSchool + matchLevel + matchOrganisation + matchLogo + matchStyles + matchTeacher;

            }

        })

        afterAjax();

        // var svar = response[0];
        // html += "<li>" + svar.id + "</li>";
        // if(matchTeacher){
        //   writeHTML();
        // }
        //Write html for the cards
        function writeHTML(matchId, matchTitle, matchLink, matchCity, matchCourseName, matchDay, matchTime, matchAge, matchCourseTime, matchSchool, matchLevel, matchOrganisation, matchLogo, matchStyles, matchTeacher, matchPrice){


          html += "<li class='small-12 medium-6 large-4 columns card' id='course-id-" + matchId + "'>";

          html += "<div class='columns medium-12 large-12 no-padding-side course-heading'>";

            html += "<div class='no-padding-side medium-11 large-11 columns'><h3>";
            html += matchTitle;
            html += "</h3></div>";

            html += "<div class='no-padding-side medium-1 large-1 columns text-right'>";
            html += "<a href='" + matchLink + "' target='_blank'><i class='fa fa-dot-circle-o'></i>></i></a>";
            html += "</div>";

          html += "</div>";

          html += "<div class='container columns'>";

            html += "<div class='course-logo'>";
              html += "<img src=" + matchLogo + ">";
            html += "</div>";

            html += "<div class='row'>";

              html += "<div class='course-info columns medium-6 large-6'>";
                html += "<label>Dag / Tid</label>";
                html += "<p>" + matchDay + " / " + matchTime + "</p>";
                html += "<label>Antal ggr / tim</label>";
                html += "<p>12 ggr / 18 tim</p>";

                html += "<label>Pris</label>";
                html += "<p>" + matchPrice + "</p>";
              html += "</div>";

              html += "<div class='course-info text-right columns medium-6 large-6'>";
                html += "<label>Kursstart</label>";
                html += "<p>1 jan</p>"
                html += "<label> Ålder</label>"
                html +=  "<p>" + matchAge + "</p>";

              html += "</div>";
            html += "</div>";

            html += "<div class='course-nav row'>";
              html += "<div class='columns medium-9'>";
                html += "<div class='circle " + matchLevel + "'><span>" + matchLevel + "</span></div>";
              html += "</div>";

              html += "<div class='columns medium-3'>";
                html += "<a href ='" + matchLink + "'><i class='fa fa-arrow-circle-right'></i></a>";
              html += "</div>";
            html += "</div>";

            html += "<p>" + matchStyles + "</p>";
            html += "<p>" + matchTeacher + "</p>";

          html += "</div>";
          html += "</div>";



          html += "</li>";
        }

        courseSearch.find('ul').append(html);

    }, //success
    error: function( error ) {
      console.log("timeout");
    }



  })
  }
})
