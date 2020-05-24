$(document).ready(function(){

  let countries = "https://restcountries.eu/rest/v2/all";

  $.ajax({
    url: countries,
    context: document.body
  }).done(function(res) {
    res.forEach(e => {   
        $(".recieveCountries").append(`
        <option>
          +${e.callingCodes[0]}        
        </option>
      `);
    });
  });
})