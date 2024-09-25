<?php
// dapat  wala neto dahil lopgin page sya 
include("footer.html");
//may bug to haahahahah for visualization only yung login page 
session_start();
include("registrationdb.php");
// Check if the user is already logged in via the remember me cookie
if (isset($_COOKIE['authToken'])) {
    $authToken = $_COOKIE['authToken'];
    
    // Verify the token (example implementation)
    if ($authToken === 'validAuthToken') {
        // If token is valid, set the session
        $_SESSION['loggedin'] = true;
        header("Location: Welcome.php");
        exit();
    }
}

// Handle POST request for login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are set and not empty
    if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
        // Retrieve username and password from form
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    
        //$valid_username = "0123456789";
       // $valid_password = "longasspassword";
       $query="SELECT Password from register_info where Username='$username' limit 1";
       $result=mysqli_query($conn,$query);

        if ($result && mysqli_num_rows($result)>0 ) {
          $user_info=mysqli_fetch_assoc($result);
          $hashedpass=$row['Password'];
         if (password_verify($password,$hashedpass)){
            $_SESSION['loggedin'] = true;

            // Handle the "Remember Me" checkbox
            if (isset($_POST['rememberMe'])) {
                $authToken = 'validAuthToken'; // Example token, should be generated securely
                setcookie('authToken', $authToken, time() + (86400 * 2), "/"); // 2 days
                setcookie('username', $username, time() + (86400 * 2), "/"); // 2 days
                setcookie('rememberMe', 'true', time() + (86400 * 2), "/"); // 2 days
            } else {
                // Clear cookies if "Remember Me" is not checked
                setcookie('authToken', '', time() - 3600, "/");
                setcookie('username', '', time() - 3600, "/");
                setcookie('rememberMe', '', time() - 3600, "/");
            }

            // Redirect to welcome page or perform other actions
            header("Location: Welcome.php");
            exit();
        } else {
            $textColor = 'red';
            echo "<p style='color: $textColor;'>Invalid username or password.</p>";
        }
    } else {
        // Handle case where credentials are not received
        echo "Credentials not received.";
    }
}
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="navbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <style>
     body {
  background: linear-gradient(to bottom, #02072F, #021274),no-repeat;
  background-size: cover;
  background-attachment: fixed;
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 200vh;
  color: white;
  text-align: center;
}

.content {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
  margin-bottom: 30px;
  margin-top: 100px;
  flex: 1; 
  padding-bottom: 10px; 
}

h1 {
  padding: 10px;
  font-size: 36px; /* Increased font size */
  font-family: 'Orbitron', sans-serif;
}

.center-button-container {
  display: flex;
  justify-content: center;
  width: 100%;
  margin: 20px 0;
}

button.login-btn {
  background: linear-gradient(45deg, blue, #910216);
  color: white;
  padding: 20px 100px;
  margin: 8px 0;
  margin-top:50px;
  border: none;
  cursor: pointer;
  display: block;
  max-width: 300px;
  text-align: center;
  font-size: 18px; /* Increased font size */
  
}

button.login-btn:hover {
  background: linear-gradient(315deg, #1AF0F0, #FF0000);
}

.container {
  padding: 16px;
  color: black;
  text-align: left;
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  font-size: 18px; /* Increased font size */
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  display: block;
  text-align: center;
  font-size: 18px; /* Increased font size */
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

span.psw {
  float: right;
  padding-top: 16px;
}

.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0,0.4);
  padding-top: 60px;
}

.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto;
  border: 1px solid #888;
  width: 80%;
}

.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover, .close:focus {
  color: red;
  cursor: pointer;
}

.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s;
}

@-webkit-keyframes animatezoom {
  from { -webkit-transform: scale(0); } 
  to { -webkit-transform: scale(1); }
}

@keyframes animatezoom {
  from { transform: scale(0); } 
  to { transform: scale(1); }
}

@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }
  .cancelbtn {
    width: 100%;
  }
}


/* Style for the entire page */
::-webkit-scrollbar {
  width: 12px; /* Width of the scrollbar */
}

::-webkit-scrollbar-track {
  background: #f1f1f1; /* Background of the scrollbar track */
}

::-webkit-scrollbar-thumb {
  background: #888; /* Color of the scrollbar thumb */
  border-radius: 6px; /* Roundness of the scrollbar thumb */
}

::-webkit-scrollbar-thumb:hover {
  background: #555; /* Color when hovering over the scrollbar thumb */
}
html, body {
  overflow: auto; /* Ensures scrollbars are enabled */
  margin: 0; /* Removes default margins */
  padding: 0; /* Removes default padding */
}
    </style>
</head>
<body>
  <div class="content">
    <h1>LOGIN TO (WEBSITE NAME HERE)</h1>
    <div class="center-button-container">
      <button class="login-btn" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">LOGIN</button>
    </div>
    <div id="id01" class="modal">
      <form class="modal-content animate" action="index.php" method="post" id="loginForm">
        <div class="imgcontainer">
          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
          <img src="https://img.freepik.com/premium-vector/young-smiling-man-avatar-man-with-brown-beard-mustache-hair-wearing-yellow-sweater-sweatshirt-3d-vector-people-character-illustration-cartoon-minimal-style_365941-860.jpg" alt="Avatar" class="avatar">
        </div>
        <div class="container">
          <label for="uname"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="username" id="uname" required value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>">
    
          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" id="psw" required>
    
          <label for="rememberMe">
            <input type="checkbox" name="rememberMe" id="rememberMe" <?php echo isset($_COOKIE['rememberMe']) ? 'checked' : ''; ?>> Remember Me
          </label>
    
          <button type="submit">LOGIN</button>
        </div>
      </form>
    </div>
    <div>
      <p style="text-align:center;color:white;">Don't have an account? Click <a href="registration.php">here</a></p>
    </div>
  </div>
</body>
<footer>
<p>© 2024 Your Website. All rights reserved.</p><br>
<a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
<p>About us </p>
</footer>
</html>
