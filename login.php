<?php
    require "libs/session.php";
    require "libs/database.php";
    require "libs/function.php";

    if (isLoggedin()) {
        header("location: profile.php");
        exit;
    }   

    $username = $password =  "";
    $username_err = $password_err = $login_err = "";
    $email = "";

    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if (empty(trim($_POST["username"]))) {
            $username_err = "Enter Your Username";
        } else{
            $username = trim($_POST["username"]);

        }

        if (empty(trim($_POST["password"]))) {
            $password_err = "Enter Your Password";
        } else{
            $password = trim($_POST["password"]);

        }

        if (empty($username_err) && empty($password_err)) {
            $sql = "SELECT id, username, email, password, user_img, user_type FROM users WHERE username = ?";

            if ($stmt = mysqli_prepare($connection, $sql)) {
                $param_username = $username;
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        mysqli_stmt_bind_result($stmt,$id,$username,$email,$hashed_password,$userimg,$user_type);
                        if (mysqli_stmt_fetch($stmt)) {
                            if (password_verify($password,$hashed_password)) {

                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                $_SESSION["email"] = $email;
                                $_SESSION["user_img"] = $userimg;
                                $_SESSION["user_type"] = $user_type;

                                header("location: profile.php");
                            }else{
                                $login_err = "Wrong Password";
                            }
                        }
                    }else {
                        $login_err = "Wrong Username";
                    }
                }else{
                    $login_err = "An Unknown Error Occurred";
                }

                mysqli_stmt_close($stmt);
            }
        }
    
        mysqli_close($connection);
    }

?>
<?php include "view/_header.php"; ?>
<?php include "view/_sidebar.php"; ?>
<div style="height: 100vh;" id="content">
    <div class="container">
    <?php 
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">'.$login_err.'</div>';
        }
    ?>
        <div class="row p-2 animate__animated animate__fadeIn" >
        <h1 class="text-center mt-5">Giriş Yap</h1>
            <div class="col-12 d-flex justify-content-center p-2">
                <div id="login-card" style=" border-radius: 0%; background-image: linear-gradient(144deg,  #002943,#296e98,#212e36);"  class="card mt-3 w-50 p-2">
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label text-light">Username</label>
                                <input style="border-radius: 0%;" type="text" name="username" id="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid': ''?>" value="<?php echo $username ?>">
                                <span class="invalid-feedback text-light"><?php echo $username_err ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label  text-light">Password</label>
                                <input style="border-radius: 0%;" type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? ' is-invalid':' '?>" value="<?php echo $password ?>">
                                <span class="invalid-feedback text-light"><?php echo $password_err ?></span>
                            </div>
                                <input style="border-radius: 0%;" type="submit" name="login" id="login-submit" value="Login" class="btn">
                        </form> 
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>

<?php include "view/_footer.php" ?>
