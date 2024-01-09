<?php
require("includes/head.php");

$news = "SELECT * FROM `news`";
$newsResult = mysqli_query($connection, $news);
$new = mysqli_fetch_all($newsResult, MYSQLI_ASSOC);
//var_dump($new);
$hours = $new[0]['hours'];
$info = $new[0]['info'];


include("navigation/header.php"); 
?>




<div class="about">
    <fieldset>
        <legend>
            <h1>Opening Hours</h1>
        </legend>
        <p> <?= $hours ?> </p>
    </fieldset>
    <fieldset>
        <legend>
            <h1>About Us</h1>
        </legend>
        <p> <?= $info ?>
        </p>
    </fieldset>

</div>

<!-- <div class="about">
    <fieldset>
        <legend>
            <h1>Opening Hours</h1>
        </legend>
        <p>24/7. <br>
            As soon as the transaction goes through, the <b>game key</b> will automatically be sent to your mail.
        </p>
    </fieldset>
    <fieldset>
        <legend>
            <h1>About Us</h1>
        </legend>
        <p>We here at DWP games are a collection of video game loving nerds who just want to take a minute of your time to talk about Games. <br>
            Based in Esbjerg, Denmark, we're a small company yet our concerns are big, one of them being "how do we get the games to you as fast as possible? <br>
            That right! <b>Game Keys!</b> <br>
            That's our livelyhood right here, selling these keys for a reasonable price, but the main fruits of our labor is just seeing you, the gamers, fulfilled to your little cores.  So come on down to DWP Games and get ya some real authentic game keys!<br><br>
            The way it works is easy, there's just two steps to the process: <br>
            - Pick a game. <br>
            - Complete Transaction. <br><br>
            Bada boom bada bing, check your email! 👈😎👈 <br> <br>
            When you open that mail there's your code, all that's left to do is redeem it on the account of your choosing.
            <br><br><br>
            Sincerely,
            <br>
            DWP GAMES
        </p>
    </fieldset>

</div> -->


<?php include("navigation/footer.php"); ?>