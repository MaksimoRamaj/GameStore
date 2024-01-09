<?php
require("includes/head.php");
$db = new DbCon();


//check id parameter
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connection, $_GET['id']);

    $sql = "SELECT * FROM games WHERE id = $id";

    $result = mysqli_query($connection, $sql);

    $product = mysqli_fetch_assoc($result);

    $genre = $product['Genre'];

    mysqli_free_result($result);


    $rate = $product['Rating'];
    $color = "";
    if ($rate < 4) {
        $color = "red";
    } elseif ($rate < 6) {
        $color = "yellow";
    } else {
        $color = "lightgreen";
    }
};

if (isset($_POST['add'])) {
    //print_r($_POST['product_id']);
    if (isset($_SESSION['cart'])) {
        $product_array_id = array_column($_SESSION['cart'], "product_id");

        if (in_array($_POST['product_id'], $product_array_id)) {
            echo "Product is already in your cart";
        } else {
            $count = count($_SESSION['cart']);
            $product_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $product_array;
        }
    } else {
        $product_array = array(
            'product_id' => $_POST['product_id']
        );

        // new session variable
        $_SESSION['cart'][0] = $product_array;
    }
}


// Displays the four best sales by ordering prices low to high
$price = "SELECT id, Thumbnail, Price FROM games WHERE Genre LIKE '%$genre%' AND id!='$id'";
$res_price = mysqli_query($connection, $price);
$products_price = mysqli_fetch_all($res_price, MYSQLI_ASSOC);
mysqli_free_result($res_price);

mysqli_close($connection);

include("navigation/header.php");
?>

<br><br><br>

<?php if ($product) : ?>
    <div class="singleProductContainer">
        <div class="thumbnail">
            <img src="<?php echo htmlspecialchars($product['Cover']) ?>" alt="" style="width:100%">
        </div>
        <div class="titlecard">
            <h2><?php echo htmlspecialchars($product['Title']) ?></h2>
            <h3><?php echo rtrim(htmlspecialchars($product['Platform']), "/ ") ?></h3>
        </div>
        <div class="break"></div>
        <div class="dateNrate">
            <h3 class="releaseDate"> <?php echo htmlspecialchars($product['ReleaseDate']) ?></h3>
            <h3 class="rating" style="color:<?php echo $color ?>"> <?php echo htmlspecialchars($product['Rating']) ?></h3>
        </div>
        <div class="description">
            <h4><?php echo htmlspecialchars($product['Description']) ?></h4>
        </div>
        <!-- <div class="primarySpecs">
            <div class="spec">Player Count</div>
            <div class="spec">Required Space</div>
            <div class="spec">Online Players</div>
        </div> -->
        <div class="video">
            <iframe src="<?php echo htmlspecialchars($product['Trailer']) ?>" style="width:100%" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="slideshow-container">

            <?php foreach (explode(',', $product['Screenshots']) as $scr) { ?>
                <div class="mySlides fade">
                    <img src="<?php echo htmlspecialchars($scr) ?>" style="width:100%">
                </div>
            <?php } ?>


            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

        </div>
        <!-- <div class="secondarySpecs">
            <table>
                <tr>
                    <th>Age Rating</th>
                    <td>18 +</td>
                </tr>
                <tr>
                    <th>ESRB Rating</th>
                    <td>M</td>
                </tr>
                <tr>
                    <th>Multiplayer</th>
                    <td>Yes</td>
                </tr>
                <tr>
                    <th>In-game Purchases</th>
                    <td>Yes</td>
                </tr>
            </table>
        </div> -->
        <div class="productPricing">
            <!-- <h5>Old Price</h5> -->
            <h2><?php echo htmlspecialchars($product['Price']) ?> $</h2>
        </div>
        <form action="single.php?id=<?php echo $_GET['id'] ?>" method="post">
            <div class="addToBasket">
                <button type="submit" name="add">
                    <p>Add To Basket</p> <i class="materialize-icon "><span class="material-icons">shopping_cart
                        </span></i>
                </button>
            </div>
            <input type="hidden" name="product_id" value="<?php echo $product['id'] ?>">
        </form>
        <div class="related">
            <fieldset>
                <legend>
                    <h3>You may also like these items...</h3>
                </legend>
                <div class="cards">
                    <?php foreach ($products_price as $related) { ?>
                        <div class="card" onclick="window.location='single.php?id=<?php echo $related['id'] ?>'">
                            <img width="190px" height="180px" src="<?php echo htmlspecialchars($related['Thumbnail']) ?>" alt="">
                        </div>
                    <?php } ?>
                </div>
            </fieldset>
        </div>
    </div>
<?php else : ?>
    <div align="center" style="font-size: 50px;"><?php echo "The product doesn't exist." ?><br>
        <img height="80px" src="https://www.cambridge.org/elt/blog/wp-content/uploads/2019/07/Sad-Face-Emoji.png" alt="">
    </div>
<?php endif; ?>
<?php include("navigation/footer.php"); ?>

<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }
</script>