<?php
require('includes/head.php');
$db = new DbCon();

$news = "SELECT * FROM `news`";
$newsResult = mysqli_query($connection, $news);
$new = mysqli_fetch_all($newsResult, MYSQLI_ASSOC);
//var_dump($new);
$hero1 = $new[0]['hero1'];
$hero2 = $new[0]['hero2'];
$hero3 = $new[0]['hero3'];
$wHead = $new[0]['wHead'];
$wMsg = $new[0]['wMsg'];
// Gets current date
$today = date('Y-m-d');
// Determines when a product:
// is on sale.
$sale = $new[0]['sale'];
// is a new release.
$date = $today;
// is highly rated.
$rate = $new[0]['rate'];
// $sale = 200;
// $date = date('Y-m-d');
// $rate = 8;
$hours = $new[0]['hours'];

// Displays the four best sales by ordering prices low to high
$price = "SELECT id, Thumbnail, Price FROM games ORDER BY Price ASC LIMIT 6";
$res_price = mysqli_query($connection, $price);
$products_price = mysqli_fetch_all($res_price, MYSQLI_ASSOC);
mysqli_free_result($res_price);

// Displays the four newest releases by ordering release date high to low
$new = "SELECT id, Thumbnail, ReleaseDate FROM games ORDER BY ReleaseDate DESC LIMIT 6";
$res_new = mysqli_query($connection, $new);
$products_new = mysqli_fetch_all($res_new, MYSQLI_ASSOC);
mysqli_free_result($res_new);

// Displays the four highest rated items by ordering rating high to low
$popular = "SELECT id, Thumbnail, Rating FROM games ORDER BY Rating DESC LIMIT 6";
$res_popular = mysqli_query($connection, $popular);
$products_popular = mysqli_fetch_all($res_popular, MYSQLI_ASSOC);
mysqli_free_result($res_popular);

$img = "SELECT id, img FROM news";
$img1 = mysqli_query($connection, $img);
$anotherdamnname = mysqli_fetch_all($img1);
// var_dump($anotherdamnname);
mysqli_close($connection);

include("navigation/header.php");
?>

<div class="content">
    <div class="hero">
        <h1><?= $hero1 ?></h1>
        <h1><?= $hero2 ?></h1>
        <h1><?= $hero3 ?></h1>
    </div>

    <div class="weeklyMsgCont">
        <fieldset>
            <legend><h2><?= $wHead ?></h2></legend>
            <img src="assets/<?php echo $anotherdamnname[0][1]; ?>" alt="">
            <p><?= $wMsg ?></p>
        </fieldset>
    </div>

    <div>
        <?php
        if (isset($_GET['uc']) && $_GET['uc'] == 1) {
            echo "<p> User Created. </p>";
        }
        ?>
    </div>

    <div class="best-sales">
        <fieldset>
            <legend>
                <h2>Best sales ATM</h2>
            </legend>
            <div class="cards">
                <?php foreach ($products_price as $product) { ?>
                    <div class="card" onclick="window.location='single.php?id=<?php echo $product['id'] ?>'">
                        <img width="190px" height="180px" src="<?php echo htmlspecialchars($product['Thumbnail']) ?>" alt="">
                    </div>
                <?php } ?>
            </div>
        </fieldset>
        <div class="button">
            <a href="all.php?s=<?= $sale ?>">
                <h2>See all</h2>
                <span class="material-icons">keyboard_arrow_right</span>
            </a>
        </div>
    </div>

    <div class="new-releases">
        <fieldset>
            <legend>
                <h2>New releases</h2>
            </legend>
            <div class="cards">
                <?php foreach ($products_new as $product) { ?>
                    <div class="card" onclick="window.location='single.php?id=<?php echo $product['id'] ?>'">
                        <img src="<?php echo htmlspecialchars($product['Thumbnail']) ?>" alt="">
                    </div>
                <?php } ?>
            </div>
        </fieldset>
        <div class="button">
            <a href="all.php?d=<?= $date ?>">
                <h2>See all</h2>
                <span class="material-icons">keyboard_arrow_right</span>
            </a>
        </div>
    </div>

    <div class="best-rate">
        <fieldset>
            <legend>
                <h2>Best rated games</h2>
            </legend>
            <div class="cards">
                <?php foreach ($products_popular as $product) { ?>
                    <div class="card" onclick="window.location='single.php?id=<?php echo $product['id'] ?>'">
                        <img src="<?php echo htmlspecialchars($product['Thumbnail']) ?>" alt="">
                    </div>
                <?php } ?>
            </div>
        </fieldset>
        <div class="button">
            <a href="all.php?r=<?= $rate ?>">
                <h2>See all</h2>
                <span class="material-icons">keyboard_arrow_right</span>
            </a>
        </div>
    </div>
    <div class="about">
    <fieldset>
        <legend>
            <h1>Opening Hours</h1>
        </legend>
        <p> <?= $hours ?> </p>
    </fieldset>
    </div>
    <div class="platform">
        <h2>Pick your platform</h2>
        <div class="pbox pc" onclick="window.location='all.php?f=PC'"><img height="60px" src="https://icon-library.com/images/pc-game-icon/pc-game-icon-6.jpg" alt=""></div>
        <div class="pbox ps" onclick="window.location='all.php?f=PS'"><img height="120px" src="https://i.kym-cdn.com/entries/icons/original/000/012/368/playstation-wallpaper-46825-48282-hd-wallpapers.jpg" alt=""></div>
        <div class="pbox xb" onclick="window.location='all.php?f=XBOX'"><img height="90px" src="data:image/png;base64,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" alt=""></div>
        <div class="pbox nt" onclick="window.location='all.php?f=NINTENDO'"><img height="60px" src="https://games.mxdwn.com/wp-content/uploads/2018/07/2000px-Nintendo.svg_.png" alt=""></div>
    </div>
</div>

<?php include('navigation/footer.php'); ?>

</html>