document.getElementById("loginForm").addEventListener("submit", function(event) {
//
//prevent the default form submission //
  event.preventDefault();
  // Collect username and password from input fields
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;

  // Validate credentials 
  if (username === "Erigha" && password === "blessed") {
    // Redirect to the index.html page
    window.location.href = "index.html";
  } else {
    alert("Invalid username or password");
  }
}); 