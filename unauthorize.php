<?php
    require "libs/session.php";
    require "libs/function.php";
    if (!isLoggedin()) {
        header("location: login.php");
        exit;
    }   
?>
<?php include "view/_header.php"; ?>
<?php include "view/_sidebar.php"; ?>
<div id="content">
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <h3>Hello, <?php echo htmlspecialchars($_SESSION["username"]) ?></h3>
            <p>You Tried to Access Unauthorized Domain</p>
            <div>
                <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "view/_footer.php" ?>