<?php
$quantity = 0;
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./styles/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div class="header">
        <header>
            <input type="checkbox" id="check" class="check1">
            <input type="checkbox" id="check2" class="check2">

            <div class="logo" onclick="window.location='index.php'">
                <img src="./assets/Steam_icon_logo.png" alt="Steam" height="50px ">
                <h1 style="padding-left: 5px">Steam</h1>
            </div>
            <ul class="platformMenu" id="platformMenu">
                <li><a href="all.php">All Games</a></li>
                <div class="dropdown">
                    <li class="desktop_link"><a href="#">Platform</a></li>
                    <div class="dropdown-content">
                        <li><a href="all.php?f=PC">PC</a></li>
                        <li><a href="all.php?f=PS">Playstation</a></li>
                        <li><a href="all.php?f=XBOX">Xbox</a></li>
                        <li><a href="all.php?f=NINTENDO">Nintendo</a></li>
                    </div>
                </div>
                <li class="mobile_link"><a href="all.php?f=PC">PC</a></li>
                <li class="mobile_link"><a href="all.php?f=PS">Playstation</a></li>
                <li class="mobile_link"><a href="all.php?f=XBOX">Xbox</a></li>
                <li class="mobile_link"><a href="all.php?f=NINTENDO">Nintendo</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>

            <div class="icons">
                <label for="check" id="addlayer1" class="material-icons menu" style="font-size: 3em; cursor: pointer;">menu</label>
                <label class="material-icons icon cart" id="cart" onclick="window.location='cart.php'">shopping_cart</label>
                <?php if (isset($_SESSION['cart'])) {
                    $count = count($_SESSION['cart']);
                    echo "<span>$count</span>";
                } else {
                    echo "<span>0</span>";
                }
                ?>
                <label for="check2" id="addlayer2" class="material-icons icon menu">account_circle</label>
            </div>

            <ul class="userMenu" id="userMenu">
                <?php if (isset($_SESSION['usertype'])) {
                    if ($_SESSION['usertype'] == "user" || $_SESSION['usertype'] == "admin") { ?>
                        <div class="dropdown">
                            <li class="desktop_link material-icons icon"><a href="#">account_circle</a></li>
                            <div class="dropdown-content">
                                <?php if (admin()) { ?>
                                    <li><a href="admin/addproduct.php">Admin</a></li>
                                <?php }
                                if (logged_in()) {
                                    echo "<li><a href='admin/changepass.php?id=" . $_SESSION['user_id'] . "'>Change Password</a></li>";
                                    echo "<li><a href='orders.php'>Order History</a></li>";
                                } ?>
                                <li><a href="logout.php">Logout</a></li>
                            </div>
                        </div>
                        <?php if (admin()) { ?>
                            <li class="mobile_link"><a href="admin/addproduct.php">Admin</a></li>
                        <?php }
                        if (logged_in()) {
                            echo "<li><a class='mobile_link' href='admin/changepass.php?id=" . $_SESSION['user_id'] . "'> Change Password </a></li>";
                            echo "<li><a class='mobile_link' href='orders.php'>Order History</a></li>";
                        } ?>
                        <li class="mobile_link"><a href="logout.php">Logout</a></li>
                    <?php }
                } else { ?>
                    <div class="dropdown">
                        <li class="desktop_link material-icons icon"><a href="#">account_circle</a></li>
                        <div class="dropdown-content">
                            <?php if (!logged_in()) { ?>
                                <li><a href="newuser.php">Create New User</a></li>
                            <?php } ?>
                            <li><a href="login.php">Login</a></li>
                        </div>
                    </div>
                    <?php if (!logged_in()) { ?>
                        <li class="mobile_link"><a href="newuser.php">Create New User</a></li>
                    <?php } ?>
                    <li class="mobile_link"><a href="login.php">Login</a></li>
                <?php } ?>
            </ul>

            <div id="basket" style="visibility: hidden; opacity:0;">
                <div class="userinfo">
                    <h4 class="username">User's Basket</h4>
                    <h5 class="message">Here's your added items ready for quantity adjustment and checkout.</h5>
                </div>
                <div class="item">
                    <h5 class="productName">Game</h5>
                    <div class="quantity">
                        <button class="incrementer">+</button>
                        <?php echo $quantity ?>
                        <button class="decrementer">-</button>
                    </div>

                </div>
                <div class="checkout">
                    <button class="checkoutBtn">Checkout</button>
                </div>

            </div>
        </header>
    </div>
    <div id="body">


        <script>
            /* const bskt = document.getElementById("basket")
            const btn = document.getElementById("cart")
            btn.onclick = function() {
                if (bskt.style.visibility !== "hidden") {
                    bskt.style.visibility = "hidden";
                    bskt.style.opacity = "0";
                } else {
                    bskt.style.visibility = "visible";
                    bskt.style.opacity = "1";
                }
                if (document.getElementById("check").checked = true) {
                    document.getElementById("check").checked = false;
                }
                if (document.getElementById("check2").checked = true) {
                    document.getElementById("check2").checked = false;
                }
            }
            const body = document.getElementById("body")
            body.onclick = function() {
                if (bskt.style.visibility === "visible") {
                    bskt.style.visibility = "hidden";
                    bskt.style.opacity = "0";
                }
            } */

            document.getElementById("addlayer1").addEventListener("click", function() {

                var element = document.getElementById("platformMenu");
                element.classList.toggle("addlayer");
                var element = document.getElementById("userMenu");
                element.classList.remove("addlayer");
                var element = document.getElementById("check2").checked = false;
                if (bskt.style.visibility === "visible") {
                    bskt.style.visibility = "hidden";
                    bskt.style.opacity = "0";
                }
            });


            document.getElementById("addlayer2").addEventListener("click", function() {

                var element = document.getElementById("userMenu");
                element.classList.toggle("addlayer");
                var element = document.getElementById("platformMenu");
                element.classList.remove("addlayer");
                var element = document.getElementById("check").checked = false;
                if (bskt.style.visibility === "visible") {
                    bskt.style.visibility = "hidden";
                    bskt.style.opacity = "0";
                }

            });
        </script>