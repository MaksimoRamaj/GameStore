<?php

class userViewer
{
    public function displayUser()
    {
        $db = new DbCon();
        $query = $db->dbCon->prepare("SELECT * FROM accounts");
        if ($query->execute()) {
            $rows = $query->fetchAll();
            // var_dump($rows);
            foreach ($rows as $row) {
                echo
                "<div class='user'> <div class='no'>No.: " . $row["ID"] . "</div><br>" .
                    "<div class='username'>Username: " . "<div class='name'>" . "<b>" . $row["username"] . "</b></div></div><br>" .
                    "<div class='email'>Email: " . "<a href=''>" . $row["email"] . "</a></div><br>" .
                    "<div class='usertype'>Usertype: " . $row["usertype"] . "</div><br>" .
                    "<div class='Fname'>Name: " . "<i>" . $row["Fname"] . " " . $row["Lname"] . "</i></div><br>" .
                    "<div class='descrip'>Description: <div class='tion'>" . $row["description"] . "</div><br>" .
                    "<div class='btns'><a style='text-decoration: none;' href='../admin/deluser.php?id=" . $row['ID'] . "'" ?>
                onclick="return confirm('Are you sure you want to annihilate?');"
                <?php echo "> <button>Delete</button></a>" .
                    "<a style='text-decoration: none;' href='../admin/edituser.php?id=" . $row['ID'] . "'" ?>
                onclick="return confirm('Are you sure you want to influence changes?');"
                <?php echo ">  <button> Edit </button></a><br>" .
                    "<a style='text-decoration: none;' href='../admin/changepass.php?id=" . $row['ID'] . "'" ?>
                onclick="return confirm('Are you sure you want to influence changes?');"
<?php echo ">  <button> Change Password </button></a><br></div></div></div>";
            }
        }
    }
}
