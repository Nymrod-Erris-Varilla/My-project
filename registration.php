<?php
include("registrationdb.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="another-style.css"> <!-- Link to your additional CSS file -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="register-box">

    <h2>REGISTRATION FORM  (WEBSITE NAME) <br>PLEASE REGISTER BELOW</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Username:<br>
        <input type="text" name="username"><br>
        Password:<br>
        <input type="password" name="password"><br>
        <input type="submit" name="submit" value="REGISTER">
        <p style="text-align:center;color:white;"> Click <a href="true.php">here</a> to go to login page </p>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $message = ""; // Initialize message variable

        if (empty($username)) {
            $message = "Enter a Username";
        } else if (empty($password)) {
            $message = "Enter a password";
        } else {
            // Check if username already exists
            $sql = "SELECT * FROM register_info WHERE Username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $message = "That username is already taken";
            } else {
                // Username is available, proceed with registration
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO register_info (Username, Password) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $username, $hash);

                if ($stmt->execute()) {
                    $message = "You have registered successfully";
                    header("Location:true.php");
                } else {
                    $message = "Error: " . $stmt->error;
                }
            }

            $stmt->close();
        }

        echo "<p>$message</p>"; // Display message inside the register-box
    }
    ?>

  
</div>

<?php
mysqli_close($conn);
?>
</body>
</html>
