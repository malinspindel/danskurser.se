$ = jQuery;

var courseSearch = $('#course-search');

var searchForm = courseSearch.find('form');

console.log(searchForm);

searchForm.submit(function(e){
  e.preventDefault();

  // var level_one = 0;
  // var level_two = 0;
  // var level_three = 0;
  // var level_four = 0;
  // var level_five = 0;
  // var level_six = 0;
  // if(courseSearch.find('#level_1').prop("checked"))
  //   level_one = 1;
  // if(courseSearch.find('#level_2').prop("checked"))
  //   level_two = 1;
  // if(courseSearch.find('#level_3').prop("checked"))
  //   level_three = 1;
  // if(courseSearch.find('#level_4').prop("checked"))
  //   level_four = 1;
  // if(courseSearch.find('#level_5').prop("checked"))
  //   level_five = 1;
  // if(courseSearch.find('#level_6').prop("checked"))
  //   level_six = 1;

  var data = {
    action : "course_search",
    city: courseSearch.find('#city').val(),
    day: courseSearch.find('#day').val(),
    time: courseSearch.find('#time').val(),
    age: courseSearch.find('#age').val()
    // level_1: level_one,
    // level_2: level_two,
    // level_3: level_three,
    // level_4: level_four,
    // level_5: level_five,
    // level_6: level_six
  }

  $.ajax({
    url : ajax_url,
    data : data,
    success : function(response) {

      courseSearch.find("ul").empty();

      for(var i = 0; i < response.length; i++) {
        console.log(response[i]);

        var city = response[i].city;
        var school = response[i].school;
        var course_name = response[i].course_name;
        var logo = response[i].logo;
        var day = "";
        var time = response[i].course_time;
        var age = response[i].age;
        // var level = "";
        var html = "<li class='row' id='course-id-" + response[i].id + "'>";

        //Dag
        if(response[i].day == "day_mon"){
          day = "Måndag";
        }
        if(response[i].day == "day_tue"){
          day = "Tisdag";
        }
        if(response[i].day == "day_wed"){
          day = "Onsdag";
        }
        if(response[i].day == "day_thu"){
          day = "Torsdag";
        }
        if(response[i].day == "day_fri"){
          day = "Fredag";
        }
        if(response[i].day == "day_sat"){
          day = "Lördag";
        }
        if(response[i].day == "day_sun"){
          day = "Söndag";
        }


        //Nivå
        // if(response[i].level1){
        //   level += " Nybörjare";
        // }
        // if(response[i].level2){
        //   level += " Fortsättning";
        // }
        // if(response[i].level3){
        //   level += " Medel";
        // }
        // if(response[i].level4){
        //   level += " Avancerad";
        // }
        // if(response[i].level5){
        //   level += " Proffesionel";
        // }
        // if(response[i].level6){
        //   level += " Ingen nivå";
        // }
        html += "<div class='columns medium-12 large-12 no-padding-side course-heading'>";
          html += "<div class='no-padding-side medium-4 large-4 columns'>";
          html += school;
          // html += "(" + city + ")";
          html += "</div>";

          html += "<div class='no-padding-side medium-7 large-7 columns'>";
          html += course_name;
          html += "</div>";

          html += "<div class='no-padding-side medium-1 large-1 columns'>";
          html += "Adress";
          html += "</div>";

        html += "</div>";


          html += "<div class='course-logo columns medium-4 large-4'>";
            html += "<img src=" + logo + ">";
          html += "</div>";

          html += "<div class='course-info columns large-8'>";

          html += "<div class='columns medium-4 large-4'>";
            html += "<label>Dag / Tid</label>";
            html += "<p>" + day + time + "</p>";
            html += "<label> Ålder:</label>"
            html +=  "<p>" + age + "</p>";
          html += "</div>";

          html += "<div class='columns medium-4 large-4'>";
            html += "<label>Kursstart:</label>";
            html += "<p>1 jan</p>"
            html += "<label>Antal ggr / tim:</label>";
            html += "<p>12 ggr / 18 tim";
          html += "</div>";

          html += "<div class='columns medium-4 large-4'>";
            html += "<label>Pris:</label>";
            html += "<p> 3275:-</p>";
            html += "<a href ='" + response[i].link + "'><i class='fa fa-arrow-circle-right'></i>Mer info</a><br>";
          html += "</div>";

          html += "</div>";



        html += "</li>";



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
