//Transforme l'input password en input text

function fafaEye() {

  //Input password 1
  var passwordInput = document.getElementById("password");
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }

  //Input password 2
  var passwordInputConfirm = document.getElementById("passwordConfirm");
  if (passwordInputConfirm.type === "password") {
    passwordInputConfirm.type = "text";
  } else {
    passwordInputConfirm.type = "password";
  }
}