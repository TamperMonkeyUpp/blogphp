<?php
    require "libs/session.php";
    require "libs/function.php";
    
    $blog_idd = $_GET["id"];
    
    if(isLoggedin()){
        $user_idd = $_SESSION["id"];
        $userResult = getInfoByUserId($user_idd);
        $userId = mysqli_fetch_assoc($userResult);
    }
     
    if (!isset($_GET["id"]) or !is_numeric($_GET["id"])) {
        header('Location: index.php');
    }


    $result = getBlogById($_GET["id"]);
    $blog = mysqli_fetch_assoc($result);
    
    
    
   
    
    

    $comment = "";
    $comment_err = "";
    
    include "libs/database.php";
	if (isset($_POST['liked'])) {
		$blog_id = mysqli_query($connection, "SELECT * FROM blogs WHERE id=$blog_idd");
		$row = mysqli_fetch_array($blog_id);
		$n = $row['post_likes'];

		mysqli_query($connection, "INSERT INTO blog_likes (user_id, blog_id) VALUES ($user_idd, $blog_idd)");
		mysqli_query($connection, "UPDATE blogs SET post_likes=$n+1 WHERE id=$blog_idd");
		$n+1;
		
	}
	if (isset($_POST['unliked'])) {
		$blog_id = mysqli_query($connection, "SELECT * FROM blogs WHERE id=$blog_idd");
		$row = mysqli_fetch_array($blog_id);
		$n = $row['post_likes'];

		mysqli_query($connection, "DELETE FROM blog_likes WHERE blog_id=$blog_idd AND user_id=$user_idd");
		mysqli_query($connection, "UPDATE blogs SET post_likes=$n-1 WHERE id=$blog_idd");
		$n-1;
		
	}

   
   


    if (!empty($_POST["commentSend"])) {
       
        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            if (isLoggedin()) {
                    $input_comment = trim($_POST["comment"]);
    
                    if (empty($input_comment)) {
                        $comment_err="Cannot Be Empty";
                    }else{
                        $comment = controlInput($input_comment);
                    }
    
                if (empty($comment_err)) {
                    if(createCommentByBlogId($_GET["id"],$user_idd,$comment)){
                        $_SESSION['message'] = "Comment Added Successfully";
                        $_SESSION['type'] = "success";
                        header('Refresh:0');
                        
                    }else{
                        echo 'Error';
                    }
                }
            }else{
                $comment_err = "You Can't Comment Without Login";
            }    

        }
    }

?>
<?php include "view/_header.php";?>
<?php include "view/_sidebar.php";?>
<div id="content">
    <div class="container">
        <?php
        if (!empty($comnt_err)) {
            echo '<div class="alert alert-danger">'.$comnt_err.'</div>';
        }
        ?>
        <div class="row">
            <div class="col-12 p-4">
                <div style="border-radius: 0%; border:none;" class="card mt-2">
                    <div class="row">
                        <div class="col-md-12">
                                <img class="img-fluid" style="object-fit:cover;  width:550px; height:350px;"  src="img/<?php echo $blog["imageUrl"];?>" alt="title">
                            <div class="card-body">
                                <div class="d-flex p-3 align-item-start">
                                    <h1 class="card-title flex-grow-1"><?php echo $blog["title"];?></h1>
                                    <?php if(isLoggedin()):?>
                                    <?php
                                        include "libs/database.php";
                                        // determine if user has already liked this post
                                        $islike = mysqli_query($connection, "SELECT * FROM blog_likes WHERE user_id=$user_idd AND blog_id=$blog_idd");
                                    
                                        if (mysqli_num_rows($islike) == 0):?>
                                            <!-- user already likes post -->
                                            <span class="like fa-regular fa-heart" style="color: black; font-size:40px;" data-id="<?php echo $row['id']; ?>"></span>
                                            <span class="unlike hide fa-solid fa-heart" style="color: red; font-size:40px;" data-id="<?php echo $row['id']; ?>"></span>
                                        <?php else:?>
                                            <!-- user has not yet liked post -->
                                            <span class="unlike fa-solid fa-heart" style="color: red; font-size:40px;" data-id="<?php echo $row['id']; ?>"></span>
                                            <span class="like hide fa-regular fa-heart" style="color: black; font-size:40px;" data-id="<?php echo $row['id']; ?>"></span>                                          
                                        <?php endif;?>
                                        <?php else:?>
                                            <i style="font-size: 40px; color:black " class="fa-regular fa-heart "></i>
                                        <?php endif;?>
                                </div>
                                <?php include "view/_ajax.php"?>
                                    <p class="card-text"><b><?php echo htmlspecialchars_decode($blog["short_description"]);?></b></p>
                                <hr>
                                    <div id="ownerBackground">
                                    <p class="card-text"><?php echo htmlspecialchars_decode($blog["description"]);?></p>
                                    </div>
                                <hr>
                                <div class="mt-4 mb-4">
                                    <?php include "view/_message.php"; ?>
                                    <form method="POST" novalidate>
                                        <div class="mb-2 w-75">
                                            <label for="comment" class="form-label">Comment</label>
                                            <textarea style="resize:none; border-radius:0%;" rows="3" name="comment" id="comment" class="form-control <?php echo (!empty($comment_err)) ? 'is-invalid': ''?>"></textarea>
                                            <span class="invalid-feedback"><?php echo $comment_err ?></span>
                                        </div> 
                                        <input type="submit" class="btn btn-outline-secondary mt-1" name="commentSend" id="commentSend" value="Send">
                                    </form>
                                </div>
                                <hr>
                                <div class="mt-3 p-3">
                                    <h1 class="text-center"> Comments </h1>
                                    <?php
                                        $displayComment = getComment();   
                             

                                    ?>
                                    <?php if(mysqli_num_rows($displayComment) > 0):?>
                                        <?php while($c = mysqli_fetch_assoc($displayComment)):?> 
                                            
                                            <?php if(($c["blog_id"] == $_GET["id"])):?>
                                            <div class="card mb-2">
                                                <div class="card-body">
                                                    <div class="d-flex mb-2">
                                                        <img src="img/<?php echo $c["user_img"]; ?>" style="object-fit:cover; width:60px; height:60px;" onerror="this.src='img/user.png'" class="img-fluid" alt="pp">
                                                        <h3 class="card-title ml-3 mt-2 flex-grow-1"><?php echo $c["name_lastName"]?></h3>
                                                        <?php if(isAdmin()):?>
                                                            <a class="btn btn-danger h-25 " href="delete-comment.php?id=<?php echo $c["id"]?>">Delete</a>
                                                        <?php endif;?>
                                                    </div>
                                                    <p class="card-text"><?php echo $c["comment"] ?></p>
                                                </div>
                                            </div>
                                            <?php endif;?>
                                        <?php endwhile;?>
                                    <?php  else:?>
                                        <h5 style="color: red;" class="text-center">No Comments Before</h5>
                                    <?php endif;?>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<?php include "view/_footer.php" ?>
