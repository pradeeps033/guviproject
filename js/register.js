console.log("JS code is being executed");

$(document).ready(function() {

  // Handle signup form submission
  $("#registerForm").submit(function(event) {
    event.preventDefault();

    // Get form data
    var formData = {
      username: $("#username").val(),
      email: $("#email").val(),
      password: $("#password").val(),
      confirm_password: $("#confirm_password").val()
    };

    console.log(formData);

    // Send form data to backend for processing
    $.ajax({
      type: "POST",
      url: "php/register.php",
      data: formData,
      dataType: "json",
      encode: true,
      success: function(response) {
        // Handle success response
        if (response.success) {
          alert(response.message);
          console.log("AJAX form submission successful. Redirecting to login page...");
          redirectToLoginPage();
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

function redirectToLoginPage() {
  window.location.href = "login.html";
}
