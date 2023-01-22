<?php
    require "libs/function.php";
    require "libs/session.php";
?>
<?php include "view/_header.php"; ?>
<?php include "view/_sidebar.php"; ?>
<?php
    if (!isAdmin()) {
        header('Location: unauthorize.php');
    }
?>

<div id="content">
<div class="container">
        <div class="row d-flex justify-content-center align-items-center p-3">
        <?php include "view/_message.php"; ?>
            <div style="border-radius:0%; background-color:#fffaf2;" class="card mb-3 mt-3 ">
                <div class="card-body">
                    <a href="blog-create.php" style="border-radius: 0%; background-color: #002943; color:white;" id="newBlog" class="btn">New Blog</a>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered"> 
                    <thead>
                        <tr>
                            <th style="width: 80px;">Resim</th>
                            <th >Title</th>
                            <th >Active</th>
                            <th >My Recomended</th>
                            <th style="width:150phppx;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $result = getBlogs(); 
                        while($post = mysqli_fetch_assoc($result)):
                        ?>
                            <tr>
                                <td>
                                    <img src="img/<?php echo $post["imageUrl"]?>" alt="" class="img-fluid">
                                </td>
                                <td>
                                    <?php echo $post["title"]; ?>
                                </td>
                                <td>
                                    <?php if($post["isActive"]): ?>
                                        <i class="fas fa-check"></i>
                                    <?php else:?>
                                        <i class="fas fa-times"></i>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if($post["isHome"]): ?>
                                        <i class="fas fa-check"></i>
                                    <?php else:?>
                                        <i class="fas fa-times"></i>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <a class="btn btn-sm" style="background-color: #002943; color:white;" id="blogEdit" href="blog-edit.php?id=<?php echo $post["id"] ?>">Edit</a>
                                    <a class="btn btn-sm" style="background-color: rgb(174, 4, 4); color:white;" id="blogDelete" href="blog-delete.php?id=<?php echo $post["id"] ?>">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require "view/_footer.php"?>