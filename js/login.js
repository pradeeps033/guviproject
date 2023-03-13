console.log("JS code is being executed");

$(document).ready(function() {

  // Handle login form submission
  $("#loginForm").submit(function(event) {
    event.preventDefault();

    // Get form data
    var formData = {
      email: $("#email").val(),
      password: $("#password").val()
    };

    // Send form data to backend for processing
    $.ajax({
      type: "POST",
      url: "php/login.php",
      data: formData,
      dataType: "json",
      encode: true,
      success: function(response) {
        // Handle success response
        if (response.success) {
          alert(response.message);
          console.log("AJAX form submission successful. Redirecting to profile page...");
          redirectToProfilePage();
        } else {
          // Handle error response
          alert(response.message);
        }
      },
      error: function(xhr, textStatus, errorThrown) {
        console.log(xhr.responseText);
        alert("An error occurred while processing your request.");
      }
    });
  });
});

function redirectToProfilePage() {
  window.location.href = "profile.html";
}
