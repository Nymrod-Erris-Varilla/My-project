<?php
include("footer.html");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Button State</title>
    <link rel="stylesheet" href="navbar.css">
    <style>
        .button {
            padding: 10px 20px;
            color: white;
            border: none;
            cursor: pointer;
        }
        .button-on {
            background-color: green;
        }
        .button-off {
            background-color: red;
        }
        .header {
            text-align: center;
        }
        #myImage {
            display: none; /* Initially hide the image */
        }
    </style>
</head>

<body>
    <h1 class="header">REMINDERS NIGGA</h1>
    <p>1. Turn On Apache in terminal</p>
    <p>2. Turn on Auto save in vscode</p>
    <p>3. Press Go Live in VScode</p>
    <p>TO-ADD:</p>
    <p>1.)MYSQL login info integration(Dapat registered before logging in)</p>
    <p>2.)Border animation and Float input sa  registration form</p>

    <?php
    $flag = false; // Initial state
    ?>

    <button id="toggleButton" class="button <?php echo $flag ? 'button-on' : 'button-off'; ?>">
        <?php echo $flag ? 'ON' : 'OFF'; ?>
    </button>

    <br><br>
    <img id="myImage" src="https://scontent.fmnl8-1.fna.fbcdn.net/v/t39.30808-6/452916183_122233129778000962_7562756417203771879_n.jpg?_nc_cat=1&ccb=1-7&_nc_sid=833d8c&_nc_aid=0&_nc_eui2=AeHx_DePzrVbPdJyKwT-fPo9Q7RCn1phU4VDtEKfWmFThepSuJlx63jt_YC8_LQ6BRYwUccCA6Q5WkmRVp6HM4i7&_nc_ohc=Ju3hoU9Rcg8Q7kNvgFrrOv8&_nc_ht=scontent.fmnl8-1.fna&oh=00_AYBOaEcrjonshO6uY0qT72bIx7TITQ1ck7kQfxn2P3CiBQ&oe=66A6AF7A" alt="Description of the image" width="500" height="500">

    <script>
        document.getElementById('toggleButton').addEventListener('click', function() {
            var button = this;
            var img = document.getElementById('myImage');

            if (button.classList.contains('button-on')) {
                button.classList.remove('button-on');
                button.classList.add('button-off');
                button.textContent = 'OFF';
                img.style.display = 'none'; // Hide the image
            } else {
                button.classList.remove('button-off');
                button.classList.add('button-on');
                button.textContent = 'ON';
                img.style.display = 'block'; // Show the image
            }
        });
    </script>
<footer>
    <hr>
    <a href="https://youtu.be/xvFZjo5PgG0">Click this Link for free Robux</a>
    <hr>
</footer>
</body>
</html>
