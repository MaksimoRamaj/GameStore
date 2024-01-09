<?php

class productViewer
{
    public function displayProduct()
    {
        $db = new DbCon();
        $query = $db->dbCon->prepare("SELECT * FROM `games`");
        if ($query->execute()) {
            $rows = $query->fetchAll();
             // var_dump($rows);
            foreach ($rows as $row) { ?>
            <div class="currentProductContainer">
                <div class="productNo"> <?php echo "No.: " . $row["id"] ?> </div>
                <div class="productSubContainer">
                    <div class="productInfoContainer">
                        <div class="productImg"><img src="<?php echo $row["Thumbnail"] ?>" alt="thumbnail" style="width:100%;"> </div>
                    </div>
                    <div>
                        <div class="productTitle"> <?php echo "Title: " . "<b>" . $row["Title"] . "</b><br>" ?> </div>
                        <div class="productPrice"> <?php echo "Price: " . "<b>" . $row["Price"] . " $" . "</b><br>" ?> </div>
                        <div class="productReleaseDate"> <?php echo "Release Date: " . "<b>" . $row["ReleaseDate"] . "</b><br>" ?> </div>
                        <div class="productRating"> <?php echo "Rating: " . "<b>" . $row["Rating"] . "</b><br>" ?> </div>
                        <div class="productPlatform"> <?php echo "Platform: " . "<b>" . $row["Platform"] . "</b><br>" ?> </div>

                    </div>
                    <div class="productBtnContainer"> <?php echo "<a style='text-decoration: none;' href='delproduct.php?id=" . $row['id'] . "'" ?>
                        onclick="return confirm('Are you sure you want to annihilate?');"
                        <?php echo "> <button>Delete</button></a>" ?><?php echo "<a style='text-decoration: none;' href='editproduct.php?id=" . $row['id'] . "'" ?>
                        onclick="return confirm('Are you sure you want to influence changes?');"
                        <?php echo ">  <button>Edit</button></a><br>"; ?> </div>
                </div>
            </div>
        <?php }
        }
    }
}
