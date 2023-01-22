<?php
    require "libs/session.php";
    require "libs/database.php";
    require "libs/function.php";

    $username = $name_lastName = $email = $password = $confirm_password = "";
    $username_err = $name_lastName_err = $email_err = $password_err = $confirm_password_err = "";

 if (isset($_POST["register"])) {

        //validate username
        if (empty(trim($_POST["username"]))) {
            $username_err = "You Must Enter Username";
        }elseif(strlen(trim($_POST["username"])) < 5 && strlen(trim($_POST["username"])) >15){
            $username_err = "Username Must Be Between 5 and 15 Characters";
        }elseif(!preg_match('/^[a-z\d_]{5,20}$/i', $_POST["username"])){
            $username_err = "Username Can Consist of Numbers, Letters and Underscore Characters";
        }else{
            $sql = "SELECT id FROM users WHERE username = ?";

            if ($stmt = mysqli_prepare($connection, $sql)) {
                $param_username = trim($_POST["username"]);
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $username_err = "Username Taken Before";
                    }else{
                        $username = $_POST["username"];
                    }
                }else{
                    echo mysqli_error($connection);
                    echo "Error";
                }
            }
            
        }
        

        //validate ermail
        if (empty(trim($_POST["email"]))) {
            $email_err = "You Must Enter E-Mail";
        }elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $email_err = "You Entered Wrong E-Mail";
        }else{
            $sql = "SELECT id FROM users WHERE email = ?";

            if ($stmt = mysqli_prepare($connection, $sql)) {
                $param_email = trim($_POST["email"]);
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $email_err = "This E-Mail Has Been Used Before";
                    }else{
                        $email = $_POST["email"];
                    }
                }else{
                    echo mysqli_error($connection);
                    echo "Error";
                }
            }
        }

        //validate password
        if (empty(trim($_POST["password"]))) {
            $password_err = "You must enter a password";
        }elseif(strlen($_POST["password"]) < 6){
            $password_err = "Password Min. Must Have 6 Characters";
        }else{
            $password = $_POST["password"];
        }

        //validate confirm password
        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "You must re-enter the password";
        }else{
            $confirm_password = $_POST["confirm_password"];
            if (empty($password_err) && ($password != $confirm_password)) {
                 $confirm_password_err = "Passwords Do Not Match";
            }
        }

        if (empty(trim($_POST["name_lastName"]))) {
            $name_lastName_err =  "You must enter your name and surname";
        }else{
            $name_lastName = $_POST["name_lastName"];
        }

        if (empty($username_err) && empty($email_err) && empty($password_err) && empty($name_lastName_err)) {
            $sql = 'INSERT INTO users (username,name_lastName,email,password) VALUES (?,?,?,?)';

            if ($stmt = mysqli_prepare($connection, $sql)) {
                $param_name_lastName = $name_lastName;
                $param_username = $username;
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_name_lastName, $param_email, $param_password);

                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['message'] = "You Have Successfully Registered";
                    $_SESSION['type'] = "success";
                    header("Location: register.php");
                    
                }else{
                    echo mysqli_error($connection);
                    echo "Error";
                }
            }
        }

    }


    
?>
<?php include "view/_header.php";?>
<?php include "view/_sidebar.php";?>
<div style="height: 100vh;" id="content">
    <div class="container">
        <?php include "view/_message.php" ?>
        <div class="row p-2 animate__animated animate__fadeIn">
        <h1 class="text-center mt-3">Kayıt Ol</h1>
            <div class="col-12 d-flex justify-content-center">
                <div id="register-card" class="card mt-2 mb-2 w-50 p-3">
                    <div class="card-body">
                        <form action="register.php" method="POST" novalidate>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input style="border-radius: 0%;" type="text" name="username" id="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid': ''?>" value="<?php echo $username ?>">
                                <span class="invalid-feedback"></i><?php echo $username_err ?> </span>
                            </div>
                            <div class="mb-3">
                                <label for="name_lastName" class="form-label">Name - Lastname</label>
                                <input style="border-radius: 0%;" type="text" name="name_lastName" id="name_lastName" class="form-control <?php echo (!empty($name_lastName_err)) ? 'is-invalid': ''?>" value="<?php echo $name_lastName ?>">
                                <span class="invalid-feedback"></i> <?php echo $name_lastName_err ?> </span>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-Mail</label>
                                <input style="border-radius: 0%;" type="text" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? ' is-invalid':' '?>" value="<?php echo $email ?>">
                                <span class="invalid-feedback"> </i><?php echo $email_err ?> </span>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input style="border-radius: 0%;" type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? ' is-invalid':' '?>" value="<?php echo $password ?>">
                                <span class="invalid-feedback"> </i><?php echo $password_err ?> </span>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Re Password</label>
                                <input style="border-radius: 0%;" type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? ' is-invalid':' '?>" value="<?php echo $confirm_password ?>">
                                <span class="invalid-feedback"><?php echo $confirm_password_err ?> </span>
                            </div>
                                <input style="border-radius: 0%;" type="submit" name="register" id="register-submit" value="Register" class="btn">
                        </form> 
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>

<?php include "view/_footer.php" ?>
