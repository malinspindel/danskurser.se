$ = jQuery;

var courseSearch = $('#course-search');

var searchForm = courseSearch.find('form');

//Show more cards
function loadCards() {
  $('.card').css({"display":"none"});
  size_li = $("#ul-result li").size();
  x=6;
  $('#ul-result li:lt('+x+')').show();

  if(size_li > 12) {
    $('#loadMore').show();
    $('#loadMore').click(function () {
        x= (x+6 <= size_li) ? x+6 : size_li;
        $('#ul-result li:lt('+x+')').show();
        if(x == size_li){
            $('#loadMore').hide();
        }
    });
  }
}

// console.log(searchForm);
// $( document ).ready(function() {
  searchForm.submit(function(e){
    e.preventDefault();

    courseSearch.find("ul").empty();
    courseSearch.find("ul").append('<h4 class="text-center"><i class="fa fa-spinner fa-spin"></i><br>Söker</h4>');

    var emptyText = "";

    var data = {
      action : "course_search",
      city: courseSearch.find('#city').val(),
      day: courseSearch.find('#day').val(),
      time: courseSearch.find('#time').val(),
      age_from: courseSearch.find('#age_from').val(),
      age_to: courseSearch.find('#age_to').val(),
      level: courseSearch.find('#level').val(),
      styles: function getCheckboxes(checkboxName) {
                var checkboxes = document.getElementsByName(checkboxName);
                // console.log(checkboxes);
                var checked = [];
                for(var i = 0 ; i < checkboxes.length; i++){
                  if(checkboxes[i].checked){
                    checked.push(checkboxes[i].defaultValue);
                  }
                }
                return checked.length > 0 ? checked : null;
              }
    }

  var checkedBoxes = data.styles("style");

  $.ajax({
    url : ajax_url,
    data : data,
    success : function(response) {

      courseSearch.find("ul").empty();

      var emptyText = "";

      //if no courses is found in the wp_query
      if(response.length == 0) {
        emptyText="<h4 class='text-center'><i class='fa fa-frown-o'></i><br>Tyvärr, inga kurser matchade din sökning.</h4>";
        courseSearch.find('ul').append(emptyText);
      }



      for(var i = 0; i < response.length; i++) {
        // console.log(response[i]);

        var city = response[i].city;
        var school = response[i].school;
        var course_name = response[i].course_name;
        var logo = response[i].logo;
        var day = "";
        var time = response[i].course_time;
        var age_from = response[i].age_from;
        var age_to = response[i].age_to;
        var start = response[i].start;
        var hours = response[i].hours;
        var level = response[i].level;
        var styles = response[i].styles;
        var org = response[i].org;
        var org_link = "";
        var price = response[i].price;
        var teacher = response[i].teacher;

        //Get organisation link to it's post
        for(var l in org) {
          org_link = org[l].guid
        }


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

        //Nivå
        if(response[i].level == "1"){
          level = "N";
        }
        if(response[i].level == "2"){
          level = "N-F";
        }
        if(response[i].level == "3"){
          level = "F";
        }
        if(response[i].level == "4"){
          level = "F-M";
        }
        if(response[i].level == "5"){
          level = "M";
        }
        if(response[i].level == "6"){
          level = "M-A";
        }
        if(response[i].level == "7"){
          level = "A";
        }
        if(response[i].level == "8"){
          level = "P";
        }
        if(response[i].level == "9"){
          level = "ALLA";
        }

        //If teacher is not set
        if(response[i].teacher == null){
          teacher = "Ej registrerat";
        }

        //If price is not set
        if(response[i].price == null){
          price = "Ej registrerat";
        }

      //Filtering levels
        // console.log(data.level);

        if(data.level == 0 && checkedBoxes == null) {

          writeHTML();
        }

        else if(data.level == response[i].level && checkedBoxes != null){

            if(data.level == response[i].level){
              for(j = 0; j < checkedBoxes.length; j++ ){
                // console.log("forloop");
                for(k = 0 ; k < styles.length ; k++ ) {
                  if(checkedBoxes[j] == styles[k]) {
                    writeHTML();
                  }
                }
              }
            }
        }

        else if(data.level == response[i].level && checkedBoxes == null) {
          writeHTML();
        }

        else if(checkedBoxes != null && data.level == 0){

              for(j = 0; j < checkedBoxes.length; j++ ){
                for(k = 0 ; k < styles.length ; k++ ) {
                  if(checkedBoxes[j] == styles[k]) {
                    writeHTML();
                  }
                }
              }

        }

        //The html for the card
        function writeHTML(){


          html = "<li class='small-12 medium-6 large-4 columns no-padding-side card' id='course-id-" + response[i].id + "'>";

          html += "<div class='columns medium-12 large-12 no-padding-side course-heading'>";

            html += "<div class='no-padding-side small-11 medium-11 large-11 columns'><h3>";
            html += course_name;
            html += "</h3></div>";

            html += "<div class='no-padding-side small-1 medium-1 large-1 columns text-right'>";
            html += "<a href='" + org_link + "' target='_blank'><i class='fa fa-info-circle'></i></a>";
            html += "</div>";

          html += "</div>";

          html += "<div class='container columns'>";

            html += "<div class='course-logo'>";
              html += "<img src=" + logo + ">";
            html += "</div>";

            html += "<div class='row'>";

              html += "<div class='course-info columns small-6 medium-6 large-6'>";
                html += "<label>Dag / Tid</label>";
                html += "<p>" + day + " / " + time + "</p>";
                html += "<label>Antal ggr / tim</label>";
                html += "<p>" + hours + "</p>";

                html += "<label>Pris</label>";
                html += "<p>" + price + "</p>";
              html += "</div>";

              html += "<div class='course-info text-right columns small-6  medium-6 large-6'>";
                html += "<label>Kursstart</label>";
                html += "<p>" + start + "</p>"
                html += "<label> Ålder</label>"
                html +=  "<p>" + age_from + "-" + age_to + " år</p>";
                html += "<label> Lärare</label>"
                html +=  "<p>" + teacher + "</p>";


              html += "</div>";
            html += "</div>";

            html += "<div class='course-nav row'>";
              html += "<div class='columns small-9 medium-9'>";
                html += "<div class='circle " + level + "'><span class='label-level'>NIVÅ</span><br><span>" + level + "</span></div>";
              html += "</div>";

              html += "<div class='columns small-3 medium-3'>";
                html += "<a href ='" + response[i].link + "'><i class='fa fa-arrow-circle-right'></i></a>";
              html += "</div>";
            html += "</div>";

          html += "</div>";
          html += "</div>";



          html += "</li>";
        }


        courseSearch.find('ul').append(html);
        loadCards();
      }

      //give a message if ul is empty after filtering with js
      if(document.getElementById("ul-result").childNodes.length == 0) {
        emptyText="<h4 class='text-center'><i class='fa fa-frown-o'></i><br>Tyvärr, inga kurser matchade din sökning.</h4>";
        courseSearch.find('ul').append(emptyText);
      }

      // console.log(response);
    },
    error: function( error ) {
      var errorMsg = "<h3>Sorry, something went wrong. Try again later or if the problem continues, please email me at malininc.s@gmail.com. Thank you!</h3>";
      $('.section-result').append(errorMsg);
    }
  });
});
