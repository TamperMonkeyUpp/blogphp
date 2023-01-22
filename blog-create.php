<?php 
require "libs/function.php"; 
require "libs/session.php";
?>

<?php
$title = $sdescription = $description = $image = $url = "";
$title_err = $sdescription_err =  $description_err = $image_err = $url_err = "";


if ($_SERVER["REQUEST_METHOD"]=="POST") {
    //validate title
    $input_title = trim($_POST["title"]);

    if (empty($input_title)) {
        $title_err = "Title Cannot Be Passed";
    }else if(strlen($input_title) > 150){
        $title_err = "You Entered Too Many Characters For The Title";
    }else{
        $title = controlInput($input_title);
    }

    //validate description
    $input_description = trim($_POST["description"]);

    if (empty($input_description)) {
        $description_err = "Description Cannot Be Empty";
    }else if(strlen($input_description) < 10){
        $description_err = "You Entered Too Few Characters For Description ";
    }else{
        $description = controlInput($input_description);
    }

    #validate image
    if(empty($_FILES["image"]["name"])){
        $image_err = "Choose File";
    } else {
        $result = saveImage($_FILES["image"]);

        if ($result["isSuccess"] == 0) {
            $image_err = $result["message"];
        }else {
            $image = $result["image"];
        }
    }
    
    $sdescription = $_POST["sdescription"];

    #validate Url
    $input_url = trim($_POST["url"]);
    
    if (empty($input_url)) {
        $url_err = "Url Cannot Be Empty";
    }else{
        $url = controlInput($input_url);
    }

    #completed
    if (empty($title_err) && empty($description_err)) {
        if(createBlog($title,$sdescription,$description,$image,$url)){
            $_SESSION['message'] = $title." Blog Name Added";
            $_SESSION['type'] = "success";
            header('Location: admin-blogs.php');
        }else{
            echo 'hata';
        }
    }   
    
    
}


?>
<?php
    require "view/_header.php";
    include "view/_sidebar.php";
?>
    <div id="content">
        <div class="container p-3">
            <div style="border-radius:0%; background-color:#fffaf2;" class="card mt-2 mb-3">
                <div class="card-body"> 
                    <form action="blog-create.php" method="POST" enctype="multipart/form-data">
                        <h1>New Blog</h1>
                        <hr>
                    <div class="row">
                        <div class="col-9 p-4">
                            <div class="mb-3">
                                <label for="title" class="form-label"><h4>Title</h4></label>
                                <input style="border-radius:0%;" type="text" id="title" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid':''; ?>" value="<?php echo $title; ?>">
                                <span class="invalid-feedback"><strong><?php echo $title_err ?></strong></span>
                            </div>
                            <div class="mb-3">
                                <label for="sdescription" class="form-label"><h4>Short Description</h4></label>
                                <textarea style="resize:none; border-radius:0%;" name="sdescription" id="sdescription"  class="form-control"></textarea>
                            </div>
                            <div class="mb-3 h-75">
                                <label for="description" class="form-label"><h4>Description</h4></label>
                                <textarea style="resize:none;" rows="4" id="description" name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid':'';?>" ><?php echo $description; ?></textarea>
                                <span class="invalid-feedback"><strong><?php echo $description_err ?></strong></span>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <label for="image" class="form-label"><h4>İmage</h4></label>
                                <input style="border-radius:0%;" type="file" id="image" name="image" class="form-control  <?php echo (!empty($image_err)) ? 'is-invalid':''?>">
                                <span class="invalid-feedback"><strong><?php echo $image_err ?></strong></span>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="url" class="form-label"><h4>Url</h4></label>
                                <input style="border-radius:0%;" type="text" id="url" name="url" class="form-control <?php echo (!empty($url_err)) ? 'is-invalid' : '' ?>">
                                <span class="invalid-feedback"><strong><?php echo $url_err  ?></strong></span>
                            </div>
                            <hr>
                            <div class="text-end">
                                <button style="border-radius:0%; background-color: #002943; color:white;" type="submit" id="submit-hover" class="btn mt-3 w-100"><i style="font-size: 25px;" class="fa-regular fa-paper-plane"></i></button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
<?php require "view/_ckeditorr.php" ?>
<?php require "view/_footer.php"; ?>    

 

