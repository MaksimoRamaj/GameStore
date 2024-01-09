<?php
require("../includes/adminhead.php");
if (!admin()) {
    $redirect = new Redirector("../index.php");
}
$sql = "SELECT * FROM invoices";
$result = mysqli_query($connection, $sql);
$invoices = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

if(isset($_POST['update'])){
    $id = $_GET['id'];
    $status = $_POST['orderStatus'];
    if($status == 'Pending'){
        $query = "UPDATE `orders` SET `Status` = 'Delivered' WHERE orderID = '$id'";
    }
    else{
        $query = "UPDATE `orders` SET `Status` = 'Pending' WHERE orderID = '$id'";
    }
    $updateStatus = mysqli_query($connection, $query);

    if ($updateStatus) {
        $redirect = New Redirector("invoices.php");
        exit;
    } else {
        echo mysqli_error($connection);
    }
}
$color = '';
if($_POST['orderStatus'] = 'Pending'){
    $color = 'red';
}
else{
    $color = 'lightgreen';
}

mysqli_close($connection);


include("../navigation/adminNav.php");
?>

<fieldset class="orders">
    <legend>
        <h1>Invoices</h1>
    </legend>
    <table>
        <tr class="headline">
            <th>No.</th>
            <th>User's name</th>
            <th>Ordered product(s)</th>
            <th>Delivery Email</th>
            <th>Date of order</th>
            <th>Payed ammount</th>
            <th>Status</th>
        </tr>
        <?php if($invoices){ ?>
            <?php foreach($invoices as $invoice){ ?>
                <form action="invoices.php?id=<?php echo $invoice['orderID'] ?>" method="post">
                    <tr>
                        <td>#<?php echo $invoice['orderID'] ?></td>
                        <td><?php echo $invoice['Fname'] .' '. $invoice['Lname'] ?></td>
                        <td>
                            <?php foreach(explode(',', $invoice['Products']) as $product){
                                echo $product . "<br>"; 
                            }?>
                        </td>
                        <td><?php echo $invoice['DeliveryEmail'] ?></td>
                        <td class="date"><?php echo $invoice['Date'] ?></td>
                        <td><?php echo $invoice['Price'] ?> $</td>
                        <td data-status="<?php echo $invoice['Status'] ?>" class="status"><?php echo $invoice['Status'] ?></td>
                        <input type="hidden" name="orderStatus" value="<?php echo $invoice['Status'] ?>">
                        <td><button type="submit" name="update">Update</button></td>
                    </tr>
                </form>
            <?php } ?>
        <?php } else{ ?>
            <tr>
                <td>There aren't any invoices</td>
            </tr>
        <?php } ?>
    </table>
</fieldset>