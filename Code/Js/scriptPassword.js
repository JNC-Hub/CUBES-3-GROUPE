//Transforme l'input password en input text et change incone fa-eye
function fafaEye() {
  var passwordInput = document.getElementById("password");
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
}

function fafaEyeConfirm() {
  var passwordInput = document.getElementById("passwordConfirm");
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
}