<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../styles/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div class="header">
        <header class="admin">
            <input type="checkbox" id="check" class="check1">
            <input type="checkbox" id="check2" class="check2">

            <div class="logo" onclick="window.location='../index.php'">
                <img src="../assets/Steam_icon_logo.png" alt="DWP" height="50px">
                <h1 style="padding-left: 5px">DWP Games</h1>
            </div>

            <ul class="userMenu">
                <li class="desktop_link"><a href="../index.php">Home</a></li>
                <div class="dropdown">
                    <li class="desktop_link"><a href="#">Settings</a></li>
                    <div class="dropdown-content">
                        <li><a href="addproduct.php">Add Product</a></li>
                        <li><a href="products.php">Product List</a></li>
                        <li><a href="newsedit.php">Update News</a></li>
                        <li><a href="accounts.php">User List</a></li>
                        <li><a href="invoices.php">Invoices</a></li>
                        <li><a href="../logout.php">Logout</a></li>
                    </div>
                </div>
                <li class="mobile_link"><a href="../index.php">Home</a></li>
                <li class="mobile_link"><a href="addproduct.php">Add Product</a></li>
                <li class="mobile_link"><a href="products.php">Product List</a></li>
                <li class="mobile_link"><a href="newsedit.php">Update News</a></li>
                <li class="mobile_link"><a href="accounts.php">User List</a></li>
                <li class="mobile_link"><a href="invoices.php">Invoices</a></li>
                <li class="mobile_link"><a href="../logout.php">Logout</a></li>
            </ul>

            <div class="icons">
                <label for="check2" class="material-icons icon menu">menu</label>
            </div>
        </header>
    </div>