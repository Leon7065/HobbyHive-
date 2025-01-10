document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", function (event) {
    let isValid = true;
    const errorMessages = [];

    const fullname = form.fullname.value.trim();
    const username = form.username.value.trim();
    const email = form.email.value.trim();
    const phoneNumber = form.phonenumber.value.trim();
    const password = form.password.value.trim();
    const confirmPassword = form.confirm_password.value.trim();
    const gender = form.gender.value;

    if (fullname === "") {
      isValid = false;
      errorMessages.push("Full Name is required.");
    }

    if (username === "") {
      isValid = false;
      errorMessages.push("Username is required.");
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "" || !emailPattern.test(email)) {
      isValid = false;
      errorMessages.push("Valid Email is required.");
    }

    if (phoneNumber === "") {
      isValid = false;
      errorMessages.push("Phone Number is required.");
    }

    if (password === "") {
      isValid = false;
      errorMessages.push("Password is required.");
    } else if (password.length < 6) {
      isValid = false;
      errorMessages.push("Password must be at least 6 characters long.");
    }

    if (confirmPassword !== password) {
      isValid = false;
      errorMessages.push("Passwords do not match.");
    }

    if (!gender) {
      isValid = false;
      errorMessages.push("Gender is required.");
    }

    if (!isValid) {
      event.preventDefault();
      alert(errorMessages.join("\n"));
    }
  });
});
