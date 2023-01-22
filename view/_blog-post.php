<?php

$keyword = "";
$page = 1;

if (isset($_GET["q"])) {$keyword = $_GET["q"];}
if (isset($_GET["page"]) && is_numeric($_GET["page"])) $page = $_GET["page"];

$result = getBlogByFilters($keyword,$page);

?>

<?php if(mysqli_num_rows($result["data"])> 0):?>
    <?php while($post = mysqli_fetch_assoc($result["data"])):?>
        <?php if($post["isActive"]):?>
            <div style="border:none; background-color:#e2e2e2;" class="card mb-4 mr-4">
                <div class="row">
                    <div class="col-md-3">
                    <img class="img-fluid" style="width:100%; height:200px; object-fit:cover;" src="img/<?php echo $post["imageUrl"];?>" alt="image">
                    </div>
                    <div class="card-body col-md-8">
                        <h4 class="card-title"><a id="blog-title" style="color:black;" href="blog-details.php?id=<?php  echo $post["id"]; ?>"><?php echo $post["title"];?></a></h4>  
                        <p class="card-text"><?php echo htmlspecialchars_decode($post["short_description"]); ?></p>
                        <div class="d-flex">
                            <p class=" flex-grow-1"></p>
                            <span style="border-radius: 0%; color:black;" class="badge h-25 mr-1">&#10084; <?php echo$post["post_likes"]; ?></span>
                            <span style="border-radius: 0%; color:black;" class="badge h-25"><?php echo substr($post["dateAdded"], 0,10); ?></span>
                        </div>
                    </div>        
                </div>
            </div>
            <?php endif;?>
        <?php endwhile;?>
    <?php else:?>
<?php endif;?>
<?php
    
?>

<?php if($result["total_pages"] > 1):?>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php for ($x = 1; $x <= $result["total_pages"]; $x++):?>
        <li style="border-radius: 0%;" class="page-item <?php if($x == $page) echo "active";?>"><a style="border-radius: 0%;" class="page-link" href="
        <?php
        $url = "?page=".$x;
        if (!empty($keyword)) {
            $url .= "&q=".$keyword;
        }
        echo $url;
        ?>
        "><?php echo $x;?></a></li>
    <?php endfor;?>
  </ul>
</nav>

<?php endif;?>