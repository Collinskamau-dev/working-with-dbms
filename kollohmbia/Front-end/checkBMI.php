<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI and Waist-Height Ratio Calculator</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/kollohmbia/css/checkBMI.css">
<script src="http://localhost/kollohmbia/js/checkBmi.js"></script>
  </head>
  <body>
    <h1>BMI SCALE</h1>
           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <p>See your body type </p>
    <?php
    // Include database configuration
    require_once 'C:/wamp64/www/kollohmbia/config/config.php';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $weight = $_POST["weight"];
        $height = $_POST["height"];
        $waistDiameter = $_POST["waistDiameter"];
        $timestamp = date("Y-m-d H:i:s");

        // Validate form data
        if (empty($weight) || empty($height) || empty($waistDiameter)) {
            echo "Please fill in all fields.";
            exit();
        }

        // Calculate BMI
        $bmi = $weight / (($height / 100) * ($height / 100));

        // Categorize BMI
        if ($bmi < 18.5) {
            $bmiCategory = "underweight";
        } elseif ($bmi >= 18.5 && $bmi < 25) {
            $bmiCategory = "normal weight";
        } elseif ($bmi >= 25 && $bmi < 30) {
            $bmiCategory = "overweight";
        } else {
            $bmiCategory = "obese";
        }

        // Calculate waist-height ratio
        $waistHeightRatio = $waistDiameter / ($height / 100);

        // Determine results
        if ($bmiCategory == "normal weight" && $waistHeightRatio <= 0.50) {
            $results = "You are in the normal weight range and your waist-height ratio is healthy.";
        } elseif ($bmiCategory == "underweight") {
            $results = "You are underweight. Consider gaining weight through healthy eating habits and consult a healthcare professional for personalized advice.";
        } elseif ($bmiCategory == "normal weight" && $waistHeightRatio > 0.50) {
            $results = "You are in the normal weight range, but your waist-height ratio is high. Consider incorporating exercise and a healthy diet to lower your waist-height ratio.";
        } elseif ($bmiCategory == "overweight") {
            $results = "You are overweight. Consider adopting weight loss strategies, workout plans, and nutritional guidance. Consult a healthcare professional for personalized advice.";
        } else {
            $results = "You are obese. Consider adopting weight loss strategies, workout plans, and nutritional guidance. Consult a healthcare professional for personalized advice.";
        }

        // Insert data into database
        $stmt = $conn->prepare("INSERT INTO user_data (weight, height, waist_diameter, timestamp) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            echo "Error preparing statement: " . $conn->error;
        } else {
            $stmt->bind_param("ddds", $weight, $height, $waistDiameter, $timestamp);
            if (!$stmt->execute()) {
                echo "Error executing statement: " . $stmt->error;
            }
            $stmt->close();
        }

        // Close connection
        $conn->close();

        // Display results
        echo "<h1>Results</h1>";
        echo "<p```enter code here``  >" . $results . "</p>";
        echo "<a href='welcome.html'>Calculate Again</a>";

    } else {
        // Display form
        echo '<form id="calculatorForm" action="chechBMI.php" method="post">';
        echo '  <label for="weight">Weight (kg):</label>';
        echo '  <input type="number" step="0.1" id="weight" name="weight" required />';
        echo '  <br />';
        echo '  <label for="height">Height (cm):</label>';
        echo '  <input type="number" step="0.1" id="height" name="height" required />';
        echo '  <br />';
        echo '  <label for="waistDiameter">Waist Diameter (cm):</label>';
        echo '  <input
            type="number"
            step="0.1"
            id="waistDiameter"
            name="waistDiameter"
            required
          />';
        echo '  <br />';
        echo '  <button type="submit">Calculate</button>';
        echo '</form>';
    }
    ?>
    </form>
  
    <div class="blur-container">
        
        <!-- Background content goes here -->
    </div>

    <div class="input-container">
       
        >
    </div>

    <div class="info-container">
        <!-- BMI information and improvement tips will be displayed here -->
    </div>

    <script src="http://localhost/kollohmbia/js/checkBMI.js"></script>

  </body>
</html>