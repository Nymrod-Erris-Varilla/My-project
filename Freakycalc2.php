<?php
$imageUrl='https://preview.colorkit.co/color/9370db.png?size=wallpaper&static=true';
$imageUrl2='https://htmlcolorcodes.com/assets/images/colors/baby-blue-color-solid-background-1920x1080.png';
?>
<?php
include("footer.html");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="navbar.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 30px;
            background-image: url('<?php echo $imageUrl;?>');
            text-align: center; 
            margin-top:5px;
        }
        .header, .content {
            text-align: center;
        }
        .header {
            margin-bottom: 20px;
        }
        .design{
            color:black;
            text-align:center;
            font-size:35px;
            font-style:'Times New Roman',Times,Serif;
        }
        .form-container {
            width: 100%;
            padding: 30px;
            margin-top: 20px;
            margin: 0 auto; 
            text-align: center; 
            background-image: url('<?php echo $imageUrl2;?>');
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>GRAVITATIONAL CALCULATOR</h1>
        </div>
        <div class="content">
            <p>GRAVITY FORMULA .</p><br>
            <p>Universal Gravitational Constant(G) = 6.7 * 10^11</p>
        </div>
    <div>
    <form action="Freakycalc2.php" method="post">
        <label > You so fat you have the gravity of mars </label><br>
        <label for="inputField1">Enter Mass 1:</label><br>
        <input type="text" id="inputField1" name="Mass1"><br>
        <label for="inputField2">Enter Mass 2:</label><br>
        <input type="text" id="inputField2" name="Mass2"><br>
        <label for="inputField3">Enter Distance:</label><br>
        <input type="text" id="inputField3" name="Distance"><br>
        <button type="submit">GRAVITYCULATE</button>
    </form>
    <?php 
     if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Mass1']) && isset($_POST['Mass2']) && isset($_POST['Distance'])) {
        $Mass1=floatval($_POST['Mass1']);
        $Mass2=floatval($_POST['Mass2']);
        $Distance=floatval($_POST['Distance']);
        $gravitationalConstant = 6.7e-11;
        $result=($gravitationalConstant * $Mass1 * $Mass2) / ($Distance * $Distance);
        echo "<p> Result: " .$result ." N</p>";
     }
     else {
        echo "<p>No input received.</p>";
    }
    ?>
    </div>
    </div>
    <div class=form-container>
    <form action="FreakyCalc.php" method="post">
        <label class="design"> FREAKY CALCULATOR </label><br>
        <label for="inputField1">Enter Num1:</label><br>
        <input type="text" id="inputField1" name="userInput1"><br>
        <label for="inputField2">Enter Num2:</label><br>
        <input type="text" id="inputField2" name="userInput2"><br>
        <label for="operator">Select Operator:</label><br>
        <select id
        ="operator" name="userInput3">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
            <option value="**">^</option> 
            <option value="%">%</option> 
        </select><br>
        <button type="submit">FREAKCULATE</button>
    </form>
  
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['userInput1']) && isset($_POST['userInput2']) && isset($_POST['userInput3'])) {
        $userInput1 = floatval($_POST['userInput1']);
        $userInput2 = floatval($_POST['userInput2']);
        $operator = $_POST['userInput3'];

        switch ($operator) {
            case '+':
                $result = $userInput1 + $userInput2;
                echo "<p>Result: " . $result . "</p>";
                break;
            case '-':
                $result = $userInput1 - $userInput2;
                echo "<p>Result: " . $result . "</p>";
                break;
            case '*':
                    $result = $userInput1 * $userInput2;
                    echo "<p>Result: " . $result . "</p>";
                    break;
            case '/':
                    $result = $userInput1 / $userInput2;
                    echo "<p>Result: " . $result . "</p>";
                    break;
            case '**': 
                        $result = $userInput1 ** $userInput2;
                        echo "<p>Result: " . $result . "</p>";
                        break;
            case '%':
                        $result = $userInput1 / $userInput2;
                         echo "<p>Result: " . intval($result) . "</p>";
                        $result = $userInput1 % $userInput2;
                        echo "<p>Remainder: " . $result . "</p>";
                        break;                   
            default:
                echo "<p>Invalid operator selected.</p>";
        }
    } else {
        echo "<p>No input received.</p>";
    }
    ?>
    </div>
    <footer>
    <hr>
    <a href="https://youtu.be/xvFZjo5PgG0">Click this Link for free Robux</a>
    <hr>
</footer>
</body>
</html>
