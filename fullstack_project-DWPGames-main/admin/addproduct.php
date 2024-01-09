<?php
require("../includes/adminhead.php");

if (!admin()) {
    $redirect = new Redirector("../index.php");
}

$query_select = "SELECT * FROM `games`";
$result = mysqli_query($connection, $query_select) or die("DB error: " . mysqli_error($connection));
$product = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);


$Title = $Thumbnail = $Cover = $Price = $ReleaseDate = $Description = $Rating = $PlatformChck = $GenreChck = $Trailer = $Screenshots = '';
$errors = array('Title' => '', 'Price' => '', 'ReleaseDate' => '', 'Description' => '', 'Rating' => '', 'Platform' => '', 'Genre' => '', 'media' => '');
$numerror = 0;

if (isset($_POST['submit'])) {
    $Title = Secure($connection, 'Title');
    $Thumbnail = Secure($connection, 'Thumbnail');
    $Cover = Secure($connection, 'Cover');
    $Price = Secure($connection, 'Price');
    $ReleaseDate = Secure($connection, 'ReleaseDate');
    $Description = Secure($connection, 'Description');
    $Rating = Secure($connection, 'Rating');
    $PlatformChck = !empty($_POST['PlatformChck']) ? $_POST['PlatformChck'] : '';
    $Platform = "";
    if (!empty($PlatformChck)) {
        foreach ($PlatformChck as $Pchk) {
            $Platform .= $Pchk . "/";
        }
    }
    $GenreChck = !empty($_POST['GenreChck']) ? $_POST['GenreChck'] : '';
    $Genre = '';
    if (!empty($GenreChck)) {
        foreach ($GenreChck as $Gchk) {
            $Genre .= $Gchk . "/";
        }
    }
    $Trailer = Secure($connection, 'Trailer');
    $Screenshots = Secure($connection, 'Screenshots');

    $query = "INSERT INTO `product` 
            (`id`, `Title`, `Price`, `ReleaseDate`, `Description`, `Rating`, `Platform`, `Genre`) 
            VALUES 
            (NULL, '$Title', '$Price', '$ReleaseDate', '$Description', '$Rating', '$Platform', '$Genre'); 
                
                INSERT INTO `media` 
                (`mediaID`, `Thumbnail`, `Cover`, `Trailer`, `Screenshots`) 
                VALUES (NULL, '$Thumbnail', '$Cover', '$Trailer', '$Screenshots');";

    $regexp1 = "/^[\.a-zA-Z0-9,!? ]{2,600}$/";
    $regexp2 = "/^[+-]?((\d+(\.\d*)?)|(\.\d+))$/";
    $regexp3 = "/^[0-9-]{10}$/";

    if (
        !preg_match($regexp1, $_POST['Title'])
    ) {
        $errors['Title'] = " Must have a title.";
        $numerror++;
    }
    if (
        !preg_match($regexp2, $_POST['Price'])
    ) {
        $errors['Price'] = " Must have a price.";
        $numerror++;
    }
    if (
        !preg_match($regexp3, $_POST['ReleaseDate'])
    ) {
        $errors['ReleaseDate'] = " Must have a release date.";
        $numerror++;
    }
    if (
        !preg_match($regexp1, $_POST['Description'])
    ) {
        $errors['Description'] = " Must have a description.";
        $numerror++;
    }
    if (
        !preg_match($regexp2, $_POST['Rating'])
    ) {
        $errors['Rating'] = " Must have a rating.";
        $numerror++;
    }
    /* if (
        !preg_match($regexp1, $_POST['PlatformChck'])
    ) {
        $errors['Platform'] = " Must have a platform.";
        $numerror++;
    } */
    if (
        empty($Thumbnail)
        || empty($Trailer)
        || empty($Screenshots)
        || empty($Cover)
    ) {
        $errors['media'] = " Must have a trailer.";
        $numerror++;
    }
    if (
        empty($Platform)
    ) {
        $errors['Platform'] = " Must have a platform.";
        $numerror++;
    }
    if (
        empty($Genre)
    ) {
        $errors['Genre'] = " Must have a genre.";
        $numerror++;
    }
    if ($numerror == 0) {
        if (!mysqli_multi_query($connection, $query)) {
            die("DB error: " . mysqli_error($connection));
        }
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
        echo "Product added" . "<br> at " . date("h:i:sa");
        $Title = $Thumbnail = $Cover = $Price = $ReleaseDate = $Description = $Rating = $GenreChck = $PlatformChck = $Trailer = $Screenshots = '';
    }
};

include("../navigation/adminNav.php");
?>
<div class="adminContent">
    <div class="addProductContainer">
        <form method="post" action="addproduct.php">
            <fieldset>
                <legend>
                    <h3>Here you can add a new product</h3>
                </legend>
                Title:<br><input type="text" name="Title" value="<?php echo $Title ?>">
                <div style="color:red;"><?php echo $errors['Title']; ?></div> <br>
                Price:<br><input type="text" name="Price" value="<?php echo $Price ?>">
                <div style="color:red;"><?php echo $errors['Price']; ?></div> <br>
                Release Date:<br><input placeholder="YYYY-MM-DD" type="text" name="ReleaseDate" value="<?php echo $ReleaseDate ?>">
                <div style="color:red;"><?php echo $errors['ReleaseDate']; ?></div> <br>
                Description:<br><textarea class="description" type="text" name="Description"><?php echo $Description ?></textarea>
                <div style="color:red;"><?php echo $errors['Description']; ?></div> <br>
                Rating:<br><input placeholder="from 1 to 10" type="text" name="Rating" value="<?php echo $Rating ?>">
                <div style="color:red;"><?php echo $errors['Rating']; ?></div> <br>
                <div class="tickBoxContainer">
                    <div class="platformCont">
                        Platform:<br>
                        <div class="platform">
                            <div class="inputCont"> <input class="check" type="checkbox" name="PlatformChck[]" value="PS4" <?php if (isset($_POST['PlatformChck']) && in_array('PS4', $_POST['PlatformChck'])) echo "checked='checked'"; ?>>
                                <label>PS4</label>
                            </div><br>
                            <div class="inputCont"> <input class="check" type="checkbox" name="PlatformChck[]" value="PS5" <?php if (isset($_POST['PlatformChck']) && in_array('PS5', $_POST['PlatformChck'])) echo "checked='checked'"; ?>>
                                <label>PS5</label>
                            </div><br>
                            <div class="inputCont"> <input class="check" type="checkbox" name="PlatformChck[]" value="XBOX-ONE" <?php if (isset($_POST['PlatformChck']) && in_array('XBOX-ONE', $_POST['PlatformChck'])) echo "checked='checked'"; ?>>
                                <label>XBOX ONE</label>
                            </div><br>
                            <div class="inputCont"> <input class="check" type="checkbox" name="PlatformChck[]" value="XBOX-SERIES-X" <?php if (isset($_POST['PlatformChck']) && in_array('XBOX-SERIES-X', $_POST['PlatformChck'])) echo "checked='checked'"; ?>>
                                <label>XBOX SERIES X</label>
                            </div><br>
                            <div class="inputCont"> <input class="check" type="checkbox" name="PlatformChck[]" value="PC" <?php if (isset($_POST['PlatformChck']) && in_array('PC', $_POST['PlatformChck'])) echo "checked='checked'"; ?>>
                                <label>PC</label>
                            </div><br>
                            <div class="inputCont"> <input class="check" type="checkbox" name="PlatformChck[]" value="NINTENDO" <?php if (isset($_POST['PlatformChck']) && in_array('NINTENDO', $_POST['PlatformChck'])) echo "checked='checked'"; ?>>
                                <label>NINTENDO</label>
                            </div><br>
                            <div style="color:red;"><?php echo $errors['Platform']; ?></div> <br>

                        </div>
                    </div>
                    <div class="genreCont">
                        Genre: <br>
                        <div class="genre">
                            <div class="inputCont"> <input class="check" type="checkbox" name="GenreChck[]" value="Action" <?php if (isset($_POST['GenreChck']) && in_array('Action', $_POST['GenreChck'])) echo "checked='checked'"; ?>>
                                <label>Action</label>
                            </div><br>
                            <div class="inputCont"> <input class="check" type="checkbox" name="GenreChck[]" value="Adventure" <?php if (isset($_POST['GenreChck']) && in_array('Adventure', $_POST['GenreChck'])) echo "checked='checked'"; ?>>
                                <label>Adventure</label>
                            </div><br>
                            <div class="inputCont"> <input class="check" type="checkbox" name="GenreChck[]" value="RPG" <?php if (isset($_POST['GenreChck']) && in_array('RPG', $_POST['GenreChck'])) echo "checked='checked'"; ?>>
                                <label>RPG</label>
                            </div><br>
                            <div class="inputCont"> <input class="check" type="checkbox" name="GenreChck[]" value="Roguelike" <?php if (isset($_POST['GenreChck']) && in_array('Roguelike', $_POST['GenreChck'])) echo "checked='checked'"; ?>>
                                <label>Roguelike</label>
                            </div><br>
                            <div class="inputCont"> <input class="check" type="checkbox" name="GenreChck[]" value="Stealth" <?php if (isset($_POST['GenreChck']) && in_array('Stealth', $_POST['GenreChck'])) echo "checked='checked'"; ?>>
                                <label>Stealth</label>
                            </div><br>
                            <div class="inputCont"> <input class="check" type="checkbox" name="GenreChck[]" value="FPS" <?php if (isset($_POST['GenreChck']) && in_array('FPS', $_POST['GenreChck'])) echo "checked='checked'"; ?>>
                                <label>FPS</label>
                            </div><br>
                            <div class="inputCont"> <input class="check" type="checkbox" name="GenreChck[]" value="Horror" <?php if (isset($_POST['GenreChck']) && in_array('Horror', $_POST['GenreChck'])) echo "checked='checked'"; ?>>
                                <label>Horror</label>
                            </div><br>
                        </div>
                    </div>
                </div>
                
                <h3>Media</h3> <br>
                Thumbnail:<br><input type="text" name="Thumbnail" value="<?php echo $Thumbnail ?>">
                <div style="color:red;"><?php echo $errors['media']; ?></div> <br>
                Cover:<br><input type="text" name="Cover" value="<?php echo $Cover ?>">
                <div style="color:red;"><?php echo $errors['media']; ?></div> <br>
                Trailer:<br><input type="text" name="Trailer" value="<?php echo $Trailer ?>">
                <div style="color:red;"><?php echo $errors['media']; ?></div> <br>
                Screenshots:<br><textarea type="text" name="Screenshots"><?php echo $Screenshots ?></textarea>
                <div style="color:red;"><?php echo $errors['media']; ?></div> <br>
                <input class="subButton" type="submit" name="submit" value="SUBMIT"> <br>
            </fieldset>
        </form>
    </div>
</div>
<?php
include("../navigation/footer.php");
?>