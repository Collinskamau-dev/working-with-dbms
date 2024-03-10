<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="http://localhost/kollohmbia/css/styleregister.css">
</head>
<body>
    <?php
      require_once 'config/config.php';
      $username_err = "";
$email_err = "";
$password_err = "";
$confirm_password_err = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Read the request body as JSON
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            // Check if the username, email, and password fields are not empty
            if (empty($data["username"]) || empty($data["email"]) || empty($data["password"]) || empty($data["confirm_password"])) {
                echo "Error: One or more fields are empty.";
                exit();
            }

            // Check if the username, email, and password fields are not empty
            if (empty(trim($data["username"])) || empty(trim($data["email"])) || empty(trim($data["password"]))) {
                echo "Error: One or more fields are empty.";
                exit();
            }

            // Get the form data
            $username = $data["username"];
            $email = $data["email"];
            $password = $data["password"];
            $confirm_password = $data["confirm_password"];

            // Validate the username
            if (!preg_match("/^[a-zA-Z0-9_]+$/",$username)) {
                $username_err = "Only letters, numbers, and underscores are allowed.";
            } elseif (strlen($username) < 3) {
                $username_err = "Username must be at least 3 characters long.";
            }

            // Validate the email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = "Invalid email format.";
            } elseif (strpos($email, '@kollohmbia.com') === false) {
                $email_err = "Invalid email domain.";
            }

            // Validate the password
            if (strlen($password) < 8) {
                $password_err = "Password must be at least 8 characters long.";
            } elseif (!preg_match("/[!@#$%^&*]/", $password)) {
                $password_err = "Password must contain at least one special character.";
            }

            // Validate the confirm password
            if ($password != $confirm_password) {
                $confirm_password_err = "Passwords do not match.";
            }

            // Check if the email is already registered with a different account
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            if (!$stmt) {
                echo "Error: " . $conn->error;
                exit();
            }

            $stmt->bind_param('s', $email);
            if (!$stmt->execute()) {
                echo "Error: " . $stmt->error;
                exit();
            }

            $user = $stmt->fetch();
            if ($user) {
                echo "Error: The email is already registered with a different account.";
                exit();
            }

            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            if (!$stmt) {
                echo "Error: " . $conn->error;
                exit();
            }

            // Bind the parameters
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            // Execute the prepared statement
            if (!$stmt->execute()) {
                echo "Error: " . $stmt->error;
                exit();
            }

            // Close the prepared statement
            $stmt = null;
            $conn = null;

            echo "New record created successfully";
        } else {
            // Include the registration form
            echo '
            <form id="register-form" action="register_process.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="user" class="form-control" placeholder="Username" autocomplete="off" required />
                    <span class="help-block">'.$username_err.'</span>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" class="form-control" placeholder="Email Address" autocomplete="off" required />
                    <span class="help-block">'.$email_err.'</span>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required/>
                    <span class="help-block">'.$password_err.'</span>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" class="form-control" placeholder="Confirm" autocomplete="off" required/>
                    <span class="help-block">'.$confirm_password_err.'</span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit" />
                </div>
            </form>
            ';
        }
    ?>

    <script src="http://localhost/kollohmbia/js/registerscript.js"></script>
</body>
</html>