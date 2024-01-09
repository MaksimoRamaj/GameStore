<?php
require("../includes/adminhead.php");
if (!admin()) {
    $redirect = new Redirector("../index.php");
}
$id = $_GET['id'];
$query = mysqli_query($connection, "SELECT * FROM `games` WHERE ID='$id'");
$data = mysqli_fetch_array($query);

if (isset($_POST['update'])) {
    $Thumbnail = $_POST['Thumbnail'];
    $Cover = $_POST['Cover'];
    $title = $_POST['Title'];
    $price = $_POST['Price'];
    $releasedate = $_POST['ReleaseDate'];
    $description = $_POST['Description'];
    $rating = $_POST['Rating'];
    $platform = $_POST['Platform'];
    $genre = $_POST['Genre'];
    $trailer = $_POST['Trailer'];
    $screenshots = $_POST['Screenshots'];

    $sql = "UPDATE `product` SET `Title`='$title', `Price`='$price', `ReleaseDate`='$releasedate', `Description`='$description', `Rating`='$rating', `Platform`='$platform', `Genre`='$genre' WHERE ID='$id';
            UPDATE `media` SET `Thumbnail` = '$Thumbnail', `Cover` = '$Cover' `Trailer`='$trailer', `Screenshots`='$screenshots' WHERE mediaID = '$id'";
    echo $sql;
    $edit = mysqli_multi_query($connection, $sql);
    if ($edit) {
        mysqli_close($connection);
        $redirect = New Redirector("products.php");
        exit;
    } else {
        echo mysqli_error($connection);
    }
}
include("../navigation/adminNav.php");
?>

<div class="adminContent">
    <div class="editProduct">
        <form method="POST">
            <fieldset>
                <legend>
                    <h3>Update Data</h3>
                </legend>
                Thumbnail:<br><input type="text" name="Thumbnail" value="<?php echo $data['Thumbnail'] ?>" placeholder="Edit Thumbnail" Required> <br><br>
                Cover:<br><input type="text" name="Cover" value="<?php echo $data['Cover'] ?>" placeholder="Edit Cover" Required> <br><br>
                Title:<br><input type="text" name="Title" value="<?php echo $data['Title'] ?>" placeholder="Edit Title" Required> <br><br>
                Price:<br><input type="text" name="Price" value="<?php echo $data['Price'] ?>" placeholder="Edit Price" Required> <br><br>
                Release Date:<br><input type="text" name="ReleaseDate" value="<?php echo $data['ReleaseDate'] ?>" placeholder="Edit Release Date" Required> <br><br>
                Description:<br><textarea type="text" name="Description" placeholder="Edit Description" Required><?php echo $data['Description'] ?></textarea> <br><br>
                Rating:<br><input type="text" name="Rating" value="<?php echo $data['Rating'] ?>" placeholder="Edit Rating" Required> <br><br>
                Platform:<br><input type="text" name="Platform" value="<?php echo $data['Platform'] ?>" placeholder="Edit Platform" Required> <br><br>
                Genre:<br><input type="text" name="Genre" value="<?php echo $data['Genre'] ?>" placeholder="Edit Genre" Required> <br><br>
                Trailer:<br><input type="text" name="Trailer" value="<?php echo $data['Trailer'] ?>" placeholder="Edit Trailer" Required> <br><br>
                Screenshot(s):<br><textarea type="text" name="Screenshots" placeholder="Edit Screenshot(s)" Required><?php echo $data['Screenshots'] ?></textarea> <br><br><br>
                <input type="submit" name="update" value="UPDATE" class="subButton">
            </fieldset>
        </form>
    </div>
</div>

<?php include("../navigation/footer.php"); ?>
<html>