$ = jQuery;

var courseSearch = $('#course-search');

var searchForm = courseSearch.find('form');

// console.log(searchForm);
// $( document ).ready(function() {
  searchForm.submit(function(e){
    e.preventDefault();



  var data = {
    action : "course_search",
    city: courseSearch.find('#city').val(),
    day: courseSearch.find('#day').val(),
    time: courseSearch.find('#time').val(),
    age: courseSearch.find('#age').val(),
    level: courseSearch.find('#level').val()

  }

  $.ajax({
    url : ajax_url,
    data : data,
    success : function(response) {

      courseSearch.find("ul").empty();

      for(var i = 0; i < response.length; i++) {
        // console.log(response[i]);

        var city = response[i].city;
        var school = response[i].school;
        var course_name = response[i].course_name;
        var logo = response[i].logo;
        var day = "";
        var time = response[i].course_time;
        var age = response[i].age;
        var level = response[i].level;
        var html = "";

        //Dag
        if(response[i].day == "day_mon"){
          day = "Mån";
        }
        if(response[i].day == "day_tue"){
          day = "Tis";
        }
        if(response[i].day == "day_wed"){
          day = "Ons";
        }
        if(response[i].day == "day_thu"){
          day = "Tor";
        }
        if(response[i].day == "day_fri"){
          day = "Fre";
        }
        if(response[i].day == "day_sat"){
          day = "Lör";
        }
        if(response[i].day == "day_sun"){
          day = "Sön";
        }

        //Ålder
        if(response[i].age == "age_1"){
          age = "1-3 år";
        }
        if(response[i].age == "age_4"){
          age = "4-6 år";
        }
        if(response[i].age == "age_7"){
          age = "7-9 år";
        }
        if(response[i].age == "age_10"){
          age = "10-12 år";
        }
        if(response[i].age == "age_13"){
          age = "13-15 år";
        }
        if(response[i].age == "age_16"){
          age = "16+";
        }
        if(response[i].age == "age_30"){
          age = "30+";
        }
        if(response[i].age == "age_50"){
          age = "50+";
        }

        //Nivå
        if(response[i].level == "1"){
          level = "N";
        }
        if(response[i].level == "2"){
          level = "N - F";
        }
        if(response[i].level == "3"){
          level = "F";
        }
        if(response[i].level == "4"){
          level = "F - M";
        }
        if(response[i].level == "5"){
          level = "M";
        }
        if(response[i].level == "6"){
          level = "M - A";
        }
        if(response[i].level == "7"){
          level = "A";
        }
        if(response[i].level == "8"){
          level = "P";
        }
        if(response[i].level == "9"){
          level = "Alla";
        }
        console.log(data.level);
        if(data.level == 0) {
          console.log("ingen nivå vald");
          writeHTML();
        } else if(data.level == response[i].level){
          console.log("val och svar matchar");
          writeHTML();
        }


        function writeHTML(){
          html = "<li class='small-12 medium-6 large-4 columns' id='course-id-" + response[i].id + "'>";

          html += "<div class='columns medium-12 large-12 no-padding-side course-heading'>";

            html += "<div class='no-padding-side medium-11 large-11 columns'>";
            html += course_name;
            html += "</div>";

            html += "<div class='no-padding-side medium-1 large-1 columns text-right'>";
            html += "<i class='fa fa-map-pin'></i>";
            html += "</div>";

          html += "</div>";

          html += "<div class='container columns'>";

            html += "<div class='course-logo'>";
              html += "<img src=" + logo + ">";
            html += "</div>";

            html += "<div class='row'>";

              html += "<div class='course-info columns medium-6 large-6'>";
                html += "<label>Dag / Tid</label>";
                html += "<p>" + day + " / " + time + "</p>";
                html += "<label>Antal ggr / tim</label>";
                html += "<p>12 ggr / 18 tim</p>";

                html += "<label>Pris</label>";
                html += "<p> 3275:-</p>";
              html += "</div>";

              html += "<div class='course-info text-right columns medium-6 large-6'>";
                html += "<label>Kursstart</label>";
                html += "<p>1 jan</p>"
                html += "<label> Ålder</label>"
                html +=  "<p>" + age + "</p>";

              html += "</div>";
            html += "</div>";

            html += "<div class='course-nav row'>";
              html += "<div class='columns medium-9'>";
                html += "<div class='circle " + level + "'><span>" + level + "</span></div>";
              html += "</div>";

              html += "<div class='columns medium-3'>";
                html += "<a href ='" + response[i].link + "'><i class='fa fa-arrow-circle-right'></i></a>";
              html += "</div>";
            html += "</div>";

          html += "</div>";
          html += "</div>";

          html += "</li>";
        }



        courseSearch.find('ul').append(html);
      }

      console.log(response);
    },
    error: function( error ) {
      var errorMsg = "<h3>Sorry, something went wrong. Try again later or if the problem continues, please email me at malininc.s@gmail.com. Thank you!</h3>";
      $('.section-result').append(errorMsg);
    }
  });
});
