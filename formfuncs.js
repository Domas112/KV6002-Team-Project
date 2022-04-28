// Document is ready
$(document).ready(function () {
  var firstName = $("#firstName");
  var lastName = $("#lastName");
  var phone = $("#phoneno");

  $("#button").click(function () {
    $("#resBook")
      .find(".input")
      .filter(function () {
        if ($(this).val().length === 0) {
          $(this).addClass("is-danger");
          
        
        } else {
          $(this).removeClass("is-danger");
        }
      });
  });



});
