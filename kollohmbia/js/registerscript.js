document
  .getElementById("register-form")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    const formData = {
      username: document.getElementById("user").value,
      email: document.getElementById("email").value,
      password: document.getElementById("password").value,
      confirm_password: document.getElementById("confirm_password").value,
    };

    // Validate form fields
    if (
      !validateForm(
        formData.username,
        formData.email,
        formData.password,
        formData.confirm_password
      )
    ) {
      return;
    }

    fetch("http://localhost/kollohmbia/register_process.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    })
      .then((response) => response.text())
      .then((data) => {
        if (data.indexOf("Error") !== -1) {
          alert(data);
        } else {
          alert("Registration successful!");
          window.location.href = "index.php";
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });

function validateForm(username, email, password, confirmPassword) {
  if (username === "" || email === "" || password === "") {
    alert("Error: All fields are required.");
    return false;
  }

  const usernameRegex = /^[a-zA-Z0-9_]+$/;
  if (!usernameRegex.test(username)) {
    alert(
      "Error: The username can only contain letters, numbers, and underscores."
    );
    return false;
  }

  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if (!emailRegex.test(email)) {
    alert("Error: The email is not in the correct format.");
    return false;
  }

  const passwordRegex = /^(?=.*[!@#$%^&*])(?=.{8,})/;
  if (!passwordRegex.test(password)) {
    alert(
      "Error: The password must be at least 8 characters long and contain at least one special character."
    );
    return false;
  }

  if (password !== confirmPassword) {
    alert("Error: The password and confirm password fields do not match.");
    return false;
  }

  return true;
}
