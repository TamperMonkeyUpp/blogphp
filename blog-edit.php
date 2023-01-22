<style>
   
</style>

<?php
    require "libs/session.php";
    require "libs/function.php";


    $id = $_GET["id"];
    $result = getBlogById($id);
    $selectedPost = mysqli_fetch_assoc($result);
   
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        $title = $_POST["title"];
        $sdescription = controlInput($_POST["sdescription"]);
        $description = controlInput($_POST["description"]);
        $imageUrl = $_POST["imageUrl"];
        $url = $_POST["url"];
        $isActive = isset($_POST["isActive"]) ? 1 : 0;
        $isHome = isset($_POST["isHome"]) ? 1 : 0;

        if (empty($_FILES["image"]["name"])) {
            $result = saveImage($_FILES["imageUrl"]);

            if ($result["isSuccess"] == 1) {
                $imageUrl = $result["image"];
            }
        }

        if (editBlog($id, $title,$sdescription, $description, $imageUrl, $url, $isActive, $isHome)) {

            $_SESSION['message'] = $title." Named Blog Updated.";
            $_SESSION['type'] = "success";

            header('Location: admin-blogs.php');
        } else {
            echo "Error";
        }
    
    }
?>
<?php include "view/_header.php"; ?>
<?php include "view/_sidebar.php"; ?>
<div id="content">
    <div class="container p-3">
        <div style="border-radius:0%;" class="card mt-2 mb-3">
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-9">
                            <div id="edit-form">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input style="border-radius:0%;" type="text" class="form-control" name="title" id="title" value="<?php  echo $selectedPost["title"] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="sdescription" class="form-label">Short Description</label>
                                    <textarea style="border-radius:0%;" name="sdescription" id="sdescription"  class="form-control"><?php echo $selectedPost["short_description"]; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="description"><?php  echo $selectedPost["description"] ?></textarea>
                                </div>
                            </div> 
                        </div>
                        <div class="col-3">
                            <div class="form-check mb-3">
                                <input style="border-radius:0%;" type="checkbox" class="form-check-input" name="isActive" id="isActive" <?php if($selectedPost["isActive"]) {echo "checked";} ?>>
                                <label for="isActive" class="form-check-label">Active</label>
                            </div>
                            <div class="form-check mb-3">
                                <input style="border-radius:0%;" type="checkbox" class="form-check-input" name="isHome" id="isHome" <?php if($selectedPost["isHome"]) {echo "checked";} ?>>
                                <label for="isHome" class="form-check-label">My Recomended</label>
                            </div>
                            <hr>
                            <input type="hidden" name="imageUrl" value="<?php echo $selectedPost["imageUrl"] ?>">
                            <img class="img-fluid" style="width: 250px; heigth:200px;" src="img/<?php echo $selectedPost["imageUrl"] ?>" alt="image">
                            <hr>
                            <div class="mb-3">
                                <label for="imageUrl" class="form-label">İmage</label>
                                <input style="border-radius:0%;" type="file" name="imageUrl" id="imageUrl" class="form-control">
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="url" class="form-label">URL</label>
                                <input style="border-radius:0%;" type="text" class="form-control" name="url" id="url" value="<?php  echo $selectedPost["url"] ?>">
                            </div>
                            <button style="border-radius:0%; background-color: #002943; color:white;" type="submit" id="blogEditSubmit" class="btn mt-3 w-100"><i style="font-size: 25px;" class="fa-regular fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
<?php include "view/_ckeditorr.php" ?>
<?php include "view/_footer.php" ?>