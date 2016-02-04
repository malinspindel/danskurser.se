$ = jQuery;

var courseSearch = $('#course-search');

var searchForm = courseSearch.find('form');

console.log(searchForm);

searchForm.submit(function(e){
  e.preventDefault();

  var level_one = 0;
  var level_two = 0;
  var level_three = 0;
  var level_four = 0;
  var level_five = 0;
  var level_six = 0;
  if(courseSearch.find('#level_1').prop("checked"))
    level_one = 1;
  if(courseSearch.find('#level_2').prop("checked"))
    level_two = 1;
  if(courseSearch.find('#level_3').prop("checked"))
    level_three = 1;
  if(courseSearch.find('#level_4').prop("checked"))
    level_four = 1;
  if(courseSearch.find('#level_5').prop("checked"))
    level_five = 1;
  if(courseSearch.find('#level_6').prop("checked"))
    level_six = 1;

  var data = {
    action : "course_search",
    city: courseSearch.find('#city').val(),
    day: courseSearch.find('#day').val(),
    time: courseSearch.find('#time').val(),
    level_1: level_one,
    level_2: level_two,
    level_3: level_three,
    level_4: level_four,
    level_5: level_five,
    level_6: level_six
  }

  $.ajax({
    url : ajax_url,
    data : data,
    success : function(response) {

      courseSearch.find("ul").empty();

      for(var i = 0; i < response.length; i++) {
        console.log(response[i]);
        var city = response[i].city;
        var day = "";
        var time = response[i].course_time;
        var level = "";
        var html = "<h3><li id='course-id-" + response[i].id + "'><a href ='" + response[i].link + "'>" + response[i].title + "</a></h3>";

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
        if(response[i].level1){
          level = " Nybörjare";
        }
        if(response[i].level2){
          level += " Fortsättning";
        }
        if(response[i].level3){
          level += " Medel";
        }
        if(response[i].level4){
          level += " Avancerad";
        }
        if(response[i].level5){
          level += " Proffesionell";
        }
        if(response[i].level6){
          level += " Ingen nivå";
        }


        html += "Ort: " + city + "<br>";
        html += "Dag: " + day + "<br>";
        html += "Tid: " + time + "<br>";
        html += "Nivå: " + level + "<br>";
        html += "</li>";

        html += "<a href ='" + response[i].link + "'>Mer info & Anmälan</a>"

        courseSearch.find('ul').append(html);
      }

      console.log(response);
    }
  });
});
