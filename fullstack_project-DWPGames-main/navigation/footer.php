</div><footer>
    <div class="nav">
        <div class="line"></div>
        <div class="options">
            <p><a style="text-decoration: none; color:unset;" href="about.php">About</a></p>
            <p><a style="text-decoration: none; color:unset;" href="contact.php">Contact</a></p>
            <p><a style="text-decoration: none; color:unset;" href="faq.php">FAQ</a></p>
        </div>
    </div>
    <div class="policy">
    <div class="line"></div>
        <div class="policies">
            <p><a style="text-decoration: none; color:unset;" href="terms.php">Terms of Service</a></p>
            <p><a style="text-decoration: none; color:unset;" href="policy.php">Privacy Policy</a></p>
        </div>
    </div>
    <?php if(isset($_SESSION['usertype'])){ 
        if($_SESSION['usertype']=="admin") { ?>
            <img height="50px" src="https://iconarchive.com/download/i91959/icons8/windows-8/Users-Administrator.ico" alt="">
        <?php } elseif(($_SESSION['usertype']=="user")){ ?>
            <img onclick="window.location='index.php'" height="50px" src="assets/logo.png" alt="">
    <?php }} else{ ?>
        <img onclick="window.location='index.php'" height="50px" src="assets/logo.png" alt="">
    <?php } ?>
</footer>



</body>