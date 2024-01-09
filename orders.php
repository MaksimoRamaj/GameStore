<?php
require("includes/head.php");

$userID = $_SESSION['user_id'];

$sql = "SELECT * FROM orders WHERE userID = '$userID'";
$result = mysqli_query($connection, $sql);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

mysqli_close($connection);

include("navigation/header.php");
?>

<fieldset class="orders">
    <legend>
        <h1>Order History</h1>
    </legend>
    <table>
        <tr class="headline">
            <th>No.</th>
            <th>Ordered product(s)</th>
            <th>Email</th>
            <th>Date</th>
            <th>Price</th>
            <th>Status</th>
        </tr>
        <?php if($orders){ ?>
            <?php foreach($orders as $order){ ?>
                <tr>
                    <td>#<?php echo $order['orderID'] ?></td>
                    <td>
                        <?php foreach(explode(',', $order['Products']) as $product){
                            echo $product . "<br>"; 
                        }?>
                    </td>
                    <td><?php echo $order['DeliveryEmail'] ?></td>
                    <td class="date"><?php echo $order['Date'] ?></td>
                    <td><?php echo $order['Price'] ?> DKK</td>
                    <td data-status="<?php echo $order['Status'] ?>" class="status"><?php echo $order['Status'] ?></td>
                </tr>
            <?php } ?>
        <?php } else{ ?>
            <tr>
                <td>You haven't made any orders</td>
            </tr>
        <?php } ?>
    </table>
</fieldset>