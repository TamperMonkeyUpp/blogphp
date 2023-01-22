
<?php
    require "libs/session.php";
    require "libs/function.php";
?>
<?php
 require "view/_header.php";
 include "view/_sidebar.php";
?>
    <div id="content">
        <div class="container mb-3">
            <div class="row p-5">
                <div class="d-flex flex-column align-items-center">
                    <img src="img/user.png" style="width: 200px; height:200px; object-fit:cover; box-shadow:0px 0px 10px #296e98;" alt="aaa" class=" mb-3 img-fluid rounded-circle">
                    <h1 class="mb-3">Lorem Ipsum</h1>        
                </div>
                <h4 class="text-center ">Welcome to My Blog Website</h4>
                <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, tempora quibusdam vero tempore placeat nesciunt quia quo quas officia nobis eum dolore numquam architecto earum modi ea odit maxime obcaecati.</p>    
            </div>
        </div>
        <hr>
        <div class="container">
            <div class="d-flex justify-content-center">
                <h2 class="text-center">My Recomended Blogs</h2>
            </div>
            <div class="row d-flex justify-content-center align-items-center p-5">
                <?php 
                    $result = getHomePageBlogs();
                ?>
                <?php if(mysqli_num_rows($result) > 0):?>
                    <?php while($blog = mysqli_fetch_assoc($result)):?>
                    <div style="border-radius: 0%; border:none; background-color:#e2e2e2;" class="card col-md-3 mt-1 mr-3 mb-3 p-0">
                            <img src="img/<?php echo $blog["imageUrl"] ?>" class="img-fluid" style="width: 100%; height:150px; object-fit:cover;" alt="blogİmg">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                            <h5 class="card-title flex-grow-1"><a id="blog-title" style="color: black;" href="blog-details.php?id=<?php echo $blog["id"]; ?>"><?php echo $blog["title"] ?></a></h5>
                            <span style="border-radius: 0%; color:#222;" class="badge h-25 mr-1">&#10084; <?php echo $blog["post_likes"]; ?></span>
                            </div>
                            <p class="card-text"><?php echo $blog["short_description"] ?></p>
                        </div>
                    </div>
                    <?php endwhile;?>
                <?php endif;?>
            </div>
        </div>
    </div>
   
<?php require "view/_footer.php"; ?>    


 