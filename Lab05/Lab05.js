window.onload = function() {
  document.getElementById("firstName").focus();
};

function validate(formObj) {
  if (formObj.firstName.value == "") {
    alert("You must enter a first name");
    formObj.firstName.focus();
    return false;
  }

  if (formObj.lastName.value == "") {
    alert("You must enter a last name");
    formObj.lastName.focus();
    return false;
  }

  if (formObj.title.value == "") {
    alert("You must enter a title");
    formObj.title.focus();
    return false;
  }

  if (formObj.org.value == "") {
    alert("You must enter an organization");
    formObj.org.focus();
    return false;
  }

  if (formObj.pseudonym.value == "") {
    alert("You must enter a nickname");
    formObj.pseudonym.focus();
    return false;
  }

  if (formObj.comments.value == "" || formObj.comments.value == "Please enter your comments") {
    alert("You must enter comments");
    formObj.comments.focus();
    return false;
  }

  alert("Form submitted successfully!");
  return true;
}

function clearComments() {
  var commentsField = document.getElementById("comments");
  if (commentsField.value == "Please enter your comments") {
    commentsField.value = "";
  }
}

function restoreComments() {
  var commentsField = document.getElementById("comments");
  if (commentsField.value == "") {
    commentsField.value = "Please enter your comments";
  }
}

function displayNickname() {
  var firstName = document.getElementById("firstName").value;
  var lastName = document.getElementById("lastName").value;
  var nickname = document.getElementById("pseudonym").value;

  if (firstName == "" || lastName == "" || nickname == "") {
    alert("Please fill in First Name, Last Name, and Nickname fields");
  } else {
    alert(firstName + " " + lastName + " is " + nickname);
  }
}