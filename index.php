<?php
session_start();

$imageURL = "https://media1.tenor.com/m/tndccnGEcO4AAAAC/shikonokonoko-konstaga.gif";
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
          $hashedpass=$user_info['Password'];
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
            background-color: #05081c;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: white;
        }
        header {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            font-family: 'Orbitron', sans-serif;
        }
        .gif {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
            background-image: url('<?php echo $imageURL; ?>');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
        }
        body {font-family: Arial, Helvetica, sans-serif;}
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
button.login-btn {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px auto;
  border: none;
  cursor: pointer;
  width: 50%;
  display: block;
}
button.login-btn:hover {
  opacity: 0.8;
}
.headercontainer {
  width: 100%;
  height: 100px;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  color: white;
  text-align: center;
  font-size: 40px;
  padding: 20px;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
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
.container {
  padding: 16px;
  color:black;
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
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
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
footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px;
            width: 100%;
            position: relative;
            bottom: 0;
            color: black;
        }
        h1 {
            text-align: center;
            margin-bottom: 10px;
        }
        section {
            width: 100%;
            height: 30vh; /* Adjusted height */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        section #timer {
            font-size: 50px; /* Adjusted font size */
            color: #fff;
            font-weight: 700;
            display: flex;
            gap: 5px;
        }
        section #timer span {
            width: 50px; /* Adjusted width */
            text-align: center;
        }
        section #date {
            font-size: 20px; /* Adjusted font size */
            color: #b9b9b9;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <h1>WELCOME!!! WORK IN PROGRESS  WEBSITE PROJECT </h1>
    <div class="gif"></div>
    <div class="center-button-container">
        <button class="login-btn" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
    </div>
    <div id="id01" class="modal">
  
  <form class="modal-content animate" action="index.php" method="post" id="loginForm">
  <div class="imgcontainer">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        <img src="https://img.freepik.com/premium-vector/young-smiling-man-avatar-man-with-brown-beard-mustache-hair-wearing-yellow-sweater-sweatshirt-3d-vector-people-character-illustration-cartoon-minimal-style_365941-860.jpg" alt="Avatar" class="avatar">
      </div>
   <div class="container">
      <label for="uname "><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" id="uname" required value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>">
  
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" id="psw" required>
  
      <label for="rememberMe">
          <input type="checkbox" name="rememberMe" id="rememberMe" <?php echo isset($_COOKIE['rememberMe']) ? 'checked' : ''; ?>> Remember Me
      </label>
  
      <button type="submit">Login</button>
            </div>
            <p style="text-align:center;color:Black;">Don't have an account? Click <a href="registration.php">here</a></p>
        </form>
    </div>
     <section>
      <div id="timer"></div>
      <div id="date"></div>
    </section>
    <script>
      const week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
      const month = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ];

      const showTime = () => {
        const now = new Date();

        const extraH = now.getHours() < 10 ? "0" : "";
        const extraM = now.getMinutes() < 10 ? "0" : "";
        const extraS = now.getSeconds() < 10 ? "0" : "";

        const hour = `<span>${extraH}${now.getHours()}</span>`;
        const minute = `<span>${extraM}${now.getMinutes()}</span>`;
        const second = `<span>${extraS}${now.getSeconds()}</span>`;

        document.getElementById(
          "timer"
        ).innerHTML = `${hour}:${minute}:${second}`;
        document.getElementById("date").innerText = `${week[now.getDay()]}, ${
          month[now.getMonth()]
        } ${now.getDate()} ${now.getFullYear()}`;
      };

      showTime();

      setInterval(showTime, 1000);
    </script>
    <audio   autoplay loop >
    <source src="Shikanoko Nokonoko Koshitantan - Opening  4K  60FPS  Creditless.mp3">
</audio>
</body>
</html>
