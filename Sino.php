<?php
include("footer.html");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="navbar.css">
</head>
<style>
    .design {
        text-align: center;
    }
    .display {
        font-size: 16px;
        color: blue;
        background-color: lightyellow;
        padding: 10px;
        border: 1px solid blue;
        border-radius: 5px;
        margin: 5px;
    }
    .audio-container {
        margin-top: 10px;
        width: 600px; /* Set the width of the container */
        height: 350px; /* Adjust the height to show only the bottom part of the video */
        overflow: hidden; /* Hide the overflow to clip the video */
        position: relative;
        margin-left: auto; /* Center the container */
        margin-right: auto; /* Center the container */
    }
    .audio-container iframe {
        position: absolute;
        bottom: 0; /* Align the video to the bottom of the container */
        left: 0; /* Align the video to the left edge of the container */
    }
    .custom-button {
        font-size: 16px;
        padding: 10px;
        border: 1px solid blue;
        background-color: lightyellow;
        color: blue;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
    }
    .custom-button:hover {
        background-color: lightblue;
    }
</style>
<body>
    <h1 class="design">SINO MAHAL MO?</h1>
    <div class="design">
        <form action="Sino.php" method="post">
            <input type="radio" name="Her" value="Agatha">Agatha
            <input type="radio" name="Her" value="Aizel" style="margin-left: 40px;">Aizel<br><br>
            <input type="submit" name="confirm" value="Confirm"><br>
            <!-- Embed YouTube video for audio playback -->
            <div class="audio-container">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/zZ6vybT1HQs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
            </iframe>

            </div>
            
        </form>
    </div>
    <?php
    if (isset($_POST["confirm"])) {
        $Her = null;
        if (isset($_POST["Her"])) {
            $Her = $_POST["Her"];
        }
        if ($Her == "Agatha") {
            echo "<div class='display'> Sure ka mahal mo si Agatha? Do you love her because you're Nymrod Erris or are you Nymrod Erris because you love her</div>";
        } elseif ($Her == "Aizel") {
            echo "<div class='display'> May mahal ng iba si Aizel but would you lose? Nah I'd love</div>";
        } else {
            echo "<div class='display'> Wala naba talaga? </div>";
        }
    }
    ?>
    <footer>
        <hr>
        <a href="https://youtu.be/xvFZjo5PgG0">Click this Link for free Robux</a>
        <hr>
    </footer>

    <script>
        let player;

        // Load the YouTube IFrame Player API script
        const tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        const firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // Initialize the YouTube IFrame Player API
        window.onYouTubeIframeAPIReady = () => {
            player = new YT.Player('audioIframe');
        };

        // Toggle play/pause on button click
        document.getElementById('playPauseButton').addEventListener('click', () => {
            if (player && player.getPlayerState() === YT.PlayerState.PLAYING) {
                player.pauseVideo();
                document.getElementById('playPauseButton').textContent = 'Play Music';
            } else if (player) {
                player.playVideo();
                document.getElementById('playPauseButton').textContent = 'Pause Music';
            }
        });
    </script>
</body>
</html>
