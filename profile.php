<?php
    require "libs/session.php";
    require "libs/function.php";
    if (!isLoggedin()) {
        header("location: login.php");
        exit;
    }   
    
    $userID = $_SESSION["id"];
    $selectedUser = getInfoByUserId($userID);
    $sU = mysqli_fetch_assoc($selectedUser);
   
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        $id = $_SESSION["id"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $userImage = $_POST["currentImage"];

        

        if (isset($_FILES["userImage"]["name"])) {
            $result = saveImage($_FILES["userImage"]);

            if ($result["isSuccess"] == 1) {
                $userImage = $result["image"];
            }
        }
       

        if (editProfile($id, $username,$email, $password, $userImage)) {
            
            $_SESSION['message'] = "Profile Has Been Updated";
            $_SESSION['type'] = "success";

            header('Location: profile.php');
        } else {
            echo "hata";
        }
    
    }
?>
<?php include "view/_header.php"; ?>
<?php include "view/_sidebar.php"; ?>
<div style="height: 100vh;" id="content">
    <div class="container">
        <div class="row p-4">
        <?php require "view/_message.php"; ?>
            <h1 class="text-center">Profile Update</h1>
            <div class="mt-5">
                <form method="POST" enctype="multipart/form-data" novalidate>
                    <div class="row p-3">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input style="border-radius: 0%; border:1px solid black;" type="text" name="username" id="username" class="form-control " value="<?php echo $sU["username"]?>"> 
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-Mail</label>
                                <input style="border-radius: 0%; border:1px solid black;" type="text" name="email" id="email" class="form-control " value="<?php echo $sU["email"]?>">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input style="border-radius: 0%; border:1px solid black;" type="password" name="password" id="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-6 mt-4">
                            <img src="img/<?php echo $sU["user_img"]?>" alt="img" class="img-fluid" style="width:150px; height:150px;" onerror="this.src='https://via.placeholder.com/150x150'">
                            <hr>
                            <div class="mb-3">
                                <label for="userImage" class="form-label">Profile Image</label>
                                <input type="hidden" name="currentImage" value="<?php echo $sU["user_img"]?>">
                                <input style="border-radius: 0%; border:1px solid black;" type="file" name="userImage" id="userImage" class="form-control" > 
                            </div>
                            <div class="mb-3">
                                <input style="border-radius: 0%; background-color: #002943; color:white;" type="submit" name="editProfile" id="editProfile" value="Update" class="btn w-100">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "view/_footer.php" ?>