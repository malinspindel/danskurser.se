$ = jQuery;

var freeSearch = $('#free-search');

var freeSearchForm = freeSearch.find('form');

freeSearchForm.keyup(function(e){

  freeSearch.find('ul').empty();

  var data = {
    action: "free_search",
    freeSearchText: freeSearch.find('#search').val()
  }


  $.ajax({
    url : ajax_url,
    data : data,
    success : function(response) {
      console.log("response function körs");
      // for(var i = 0; i < response.length; i++) {
      //   if(response[i].id == 284) {
      //     console.log(this.parentNode);
      //   }
      // }

        var result = response.filter(function (chain) {

          // console.log(chain.id);
          console.log(data.freeSearchText);


            if(data.freeSearchText == chain.id){
              var matchId = chain.id;
              console.log("Id match!");
              return matchId;
            }
        })








    } //success




  })
})
