<?php
   if (isLoggedin()) {
    $userResult = getInfoByUserId($_SESSION["id"]);
    $userId = mysqli_fetch_assoc($userResult);
   }

?>

<a class="btn text-light" style="z-index:3; border: none; border-radius:0%; width:50px; position:fixed; background-color:#002943 !important;"  id="sidebarOpen"><i style="font-size: 25px;" class="fa-sharp fa-solid fa-arrow-right-long"></i></a>
<div id="sidebar">
    <div class="text-end">
        <a class="btn text-light" style="border:none; background-color:rgba(0, 0, 0, 0) !important;" id="sidebarClose"><i style="font-size: 25px;" class="fa-sharp fa-solid fa-arrow-left-long"></i></a>
    </div>
    <div id="cont" class="d-flex flex-column text-center mt-2 p-4">
        <div class="d-flex flex-column align-items-center">
        <?php if(isLoggedin()):?>
            <img src="img/<?php if(isset($userId["user_img"])) {echo $userId["user_img"];}else{ echo "user.png";} ?>" alt="pp" class="img-fluid" style="width: 150px; height:150px; object-fit:cover; filter: drop-shadow(0px 0px 10px #296e98);">
        <?php else:?>
            <img src="img/user.png" alt="pp" class="img-fluid" style="width: 150px; height:150px; object-fit:cover; filter: drop-shadow(0px 0px 10px #296e98);" onerror="this.src='https://via.placeholder.com/150x150'" >
        <?php endif;?>
        <p class="mt-1 "><h4 class="text-light"><?php if(isLoggedin()) { echo ucwords($userId["name_lastName"]); }else{ echo "Not Logged İn Yet"; } ?></h4></p>
        </div>
        <ul class="navbar-nav">
            <li ><a class="btn  mb-2 w-100" href="index.php"><b>Home</b></a></li>
            <li ><a class="btn  mb-2 w-100" href="blogs.php"><b>All Blog</b></a></li>
            <li ><a class="btn  mb-2 w-100" href="about.php"><b>About Me</b></a></li>
            <?php if(isAdmin()):?>
                <li ><a class="btn mb-2 w-100" href="admin-blogs.php"><b>Admin Blog</b></a></li>
            <?php endif;?>
            <?php if(isLoggedin()):?>
            <li class="d-flex">
                <a class="btn mb-2 mr-1 w-100" href="profile.php"><b>Profile</b></a>
                <a class="btn mb-2 w-100 hover-logout" href="logout.php"><b>Logout</b></a>
            </li>
            <?php else:?>
            <li class="d-flex">
                <a class="btn mb-2 mr-1 w-100" href="login.php"><b>Login</b></a>
                <a class="btn mb-2 w-100" href="register.php"><b>Register</b></a>
            </li>
            <?php endif;?>              
        </ul>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script>
     //sidebar active function
     jQuery(document).ready(function($){
        // Get current path and find target link
        var path = window.location.pathname.split("/").pop();
        
        // Account for home page with empty path
        if ( path == '' ) {
            path = 'index.php';
        }
            
        var target = $('li a[href="'+path+'"]');
        // Add active class to target link
        target.addClass('active');
        });
     //sidebar active function end
</script>
