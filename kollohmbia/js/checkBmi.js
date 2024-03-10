document
  .getElementById("calculatorForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    // Get form data
    const weight = document.getElementById("weight").value;
    const height = document.getElementById("height").value;
    const waistDiameter = document.getElementById("waistDiameter").value;
    const timestamp = new Date().toISOString();

    // Send request to server
    fetch("http://localhost/kollohmbia/Back-end/insert_data.php", {
      method: "POST",
      body: new URLSearchParams({
        weight: weight,
        height: height,
        waistDiameter: waistDiameter,
        timestamp: timestamp,
      }),
    })
      .then((response) => response.text())
      .then((data) => {
        // Display results
        const resultsDiv = document.getElementById("results");
        resultsDiv.innerHTML = data;
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });

document.getElementById("checkBtn").addEventListener("click", function () {
  const bmiValue = document.getElementById("bmiInput").value;
  const infoContainer = document.querySelector(".info-container");
  const blurContainer = document.querySelector(".blur-container");

  if (bmiValue >= 18.5 && bmiValue <= 24.9) {
    infoContainer.innerHTML =
      "You are in the normal weight range. Keep up the good work!";
  } else if (bmiValue < 18.5) {
    infoContainer.innerHTML =
      "You are underweight. Consider gaining weight through healthy eating habits.";
  } else if (bmiValue >= 25 && bmiValue <= 29.9) {
    infoContainer.innerHTML =
      "You are overweight. Consider incorporating exercise and a healthy diet.";
  } else {
    infoContainer.innerHTML =
      "You are obese. Consider adopting weight loss strategies and consulting a healthcare professional.";
  }

  infoContainer.style.display = "block";
  blurContainer.style.filter = "blur(0px)";
});
