<?php
require("../includes/adminhead.php");
if (!admin()) {
    $redirect = new Redirector("../index.php");
}
include("../navigation/adminNav.php");
?>

<div class="adminContent">
    <h2 align="center">Current Registered Products</h2>
    <div class="productList">
        <?php
        $products = new productViewer();
        $products->displayProduct();
        ?>
    </div>
</div>

<?php
include("../navigation/footer.php");
?>