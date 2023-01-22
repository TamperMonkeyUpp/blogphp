<?php
    require "libs/session.php";
    require "libs/function.php";
    require "view/_header.php";
    include "view/_sidebar.php";
?>
    <div id="content">
        <div class="container">
            <div id="blog-page" class="row d-flex justify-content-center align-items-center">
                    <?php
                        include "view/_search.php";
                    ?>
                    <?php
                        include "view/_blog-post.php";
                    ?>
            </div>
        </div>
    </div>
<?php require "view/_footer.php"; ?>    

 