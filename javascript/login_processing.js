document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  form.addEventListener("submit", validateLogin);
});

function validateLogin(event) {
  event.preventDefault(); // Prevent refrshing the page
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const message = document.querySelector(".login-notify");

  if (!email || !password) {
    message.textContent = "Please fill in all fields.";
    return;
  }

  const ajax = new XMLHttpRequest();
  ajax.open("POST", "login_processing.php", true);
  ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  ajax.onreadystatechange = function () {
    if (ajax.readyState === 4 && ajax.status === 200) {
      const response = ajax.responseText;
      if (response === "success") {
        window.location.href = "index.php?page=home";
      } else {
        message.textContent = response;
      }
    }
  };

  const params =
    "email=" +
    encodeURIComponent(email) +
    "&password=" +
    encodeURIComponent(password);
  ajax.send(params);
}
