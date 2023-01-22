<?php

# creating a blog
function createBlog(string $title,  string $sdescription, string $description, string $imageUrl, string $url, int $isActive=0) {
    include "database.php";
 
    # sorgu
    $query = "INSERT INTO blogs(title, short_description, description, imageUrl, url, isActive) VALUES (?, ?, ?, ?, ?, ?)";
    $result = mysqli_prepare($connection,$query);
    if (!mysqli_connect_errno()) {
        mysqli_stmt_bind_param($result, 'sssssi', $title,$sdescription,$description,$imageUrl,$url,$isActive);
        mysqli_stmt_execute($result);
        mysqli_close($connection);
    }

    return $result;
}


function createCommentByBlogId(int $blog_id, int $user_id_name, string $comment){
    include "libs/database.php";

    $query = "INSERT INTO blog_comments(blog_id, user_id_name , comment) VALUES (?, ?, ?)";
    $result = mysqli_prepare($connection, $query);

    if (!mysqli_connect_errno()) {
        mysqli_stmt_bind_param($result, 'iis', $blog_id,$user_id_name,$comment);
        mysqli_stmt_execute($result);
        mysqli_close($connection);
    }

    return $result;
}

function getInfoByUserId($id){
    include "libs/database.php";

    $query = "SELECT * FROM users WHERE id=$id";

    $result = mysqli_query($connection,$query);

    mysqli_close($connection);

    return $result;
    
    echo "giriş";

}

function getUserId(){
    include "libs/database.php";

    $query = "SELECT * FROM users";

    $result = mysqli_query($connection,$query);

    mysqli_close($connection);

    return $result;
}




function deleteComment($id){
    include "libs/database.php";

    $query = "DELETE FROM `blog_comments` WHERE id=$id ";
    $result = mysqli_query($connection,$query);

    mysqli_close($connection);

    return $result;
}

function getComment(){
    include "database.php";
    $query = "SELECT `blog_comments`.*,`users`.`name_lastName`,`users`.`user_img` FROM `blog_comments` ,`users` WHERE `blog_comments`.user_id_name=`users`.id ORDER BY exam_date ASC";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}


# fetch post id
function getBlogById(int $postId){
    include "database.php";
    $query = "SELECT * FROM blogs WHERE id='$postId'";

    $result = mysqli_query($connection,$query);

    mysqli_close($connection);

    return $result;
}

# Editing A Blog
function editBlog(int $id, string $title, string $sdescription,  string $description, string $imageUrl,string $url, int $isActive, int $isHome) {
    include "database.php";

    $query = "UPDATE blogs SET title='$title',short_description='$sdescription', description='$description', imageUrl='$imageUrl', url='$url', isActive=$isActive, isHome=$isHome WHERE id=$id";
    
    $result = mysqli_query($connection,$query);

    echo mysqli_error($connection);

    return $result;
}

function editLike(int $id) {
    include "database.php";

    $query = "UPDATE blogs SET title='$title',short_description='$sdescription', description='$description', imageUrl='$imageUrl', url='$url', isActive=$isActive, isHome=$isHome WHERE id=$id";
    
    $result = mysqli_query($connection,$query);

    echo mysqli_error($connection);

    return $result;
}

function editProfile(int $id, string $username, string $email,  string $password, string $user_img) {
    include "database.php";
    $param_password = password_hash($password, PASSWORD_DEFAULT);
    $passwordQuery = strlen($password) < 6 ? "" : ", password='$param_password'";
    
    $query = "UPDATE users SET username='$username',email='$email' $passwordQuery , user_img='$user_img' WHERE id=$id";
    
    $result = mysqli_query($connection,$query);

    echo mysqli_error($connection);

    return $result;
}



# Delete A Blog
function deleteBlog(int $id){
    include "database.php";
   
    $query = "DELETE FROM blogs WHERE id=$id";
    $result = mysqli_query($connection, $query);
   
    return $result;
}


# blog fetch
function getBlogs(){
    include "database.php";

    $query = "SELECT * FROM blogs";
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
    
   
    return $result;
    
}


# blogs that will appear on the homepage
function getHomePageBlogs(){
    include "database.php";

    $query = "SELECT * FROM blogs WHERE isActive=1 and isHome=1 ORDER BY dateAdded DESC";
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);

    return $result;
}




# Pagination according to the number of existing blogs and isActive status
function getBlogByFilters($keyword, $page){
    include "database.php";

    $pageCount = 10;
    $offset = ($page - 1) * $pageCount; # 1* 2
    $query = "";

    if (!empty($keyword)) {
        $query  .= "FROM blogs WHERE title LIKE '%$keyword%' OR short_description LIKE '%$keyword%' AND isActive=1";
    }else{
        $query .= "FROM blogs WHERE isActive=1";
    }

    $total_sql = "SELECT COUNT(*) ".$query;
    $count_data = mysqli_query($connection, $total_sql);
    $count = mysqli_fetch_array($count_data)[0];
    $total_pages = ceil($count / $pageCount);

    $sql = "SELECT * ".$query." LIMIT $offset, $pageCount";
    $result = mysqli_query($connection, $sql);
    mysqli_close($connection);
    return array(
        "total_pages" => $total_pages,
        "data" => $result
    );
}

#The function where we determine how many characters the description text will take
function shortDescription($description, $limit) {
    if (strlen($description) > $limit) {
        echo substr($description,0,$limit)."...";
    } else {
        echo $description;
    };
}

#A function made so that foreign resources cannot be written into the input.
function controlInput($data){
    //  $data = strip_tags($data);
     $data = htmlspecialchars($data);
    //  $data = htmlentities($data);
     $data = stripslashes($data); # sql injection

     return $data;
}


#image validate and the process of sending the image to the relevant file
function saveImage($file){
    $message = "";
    $uploadOk = 1;
    $fileTempPath = $file["tmp_name"];
    $fileName = $file["name"];
    $fileSize = $file["size"];
    $maxFileSize = (1024 * 1024) * 1;
    $dosyaUzantilari = array("jpg","jpeg","png");
    $uploadFolder = "./img/";

    if ($fileSize > $maxFileSize) {
        $message = "Dosya Boyutu Fazla.<br>";
        $uploadOk = 0;
    }

    $dosyaAdi_Arr = explode(".", $fileName);
    $dosyaAdi_uzantisiz = $dosyaAdi_Arr[0];
    $dosyaUzantisi = $dosyaAdi_Arr[1];

    if (!in_array($dosyaUzantisi, $dosyaUzantilari)) {
        $message .= "Dosya Uzantisi Kabul Edilmiyor.<br>"; 
        $message .= "Kabul Edilen Dosya Uzantilari : ".implode(", ", $dosyaUzantilari)."<br>";
        $uploadOk = 0;
    }

    $yeniDosyaAdi = md5(time().$dosyaAdi_uzantisiz).'.'.$dosyaUzantisi;
    $dest_path = $uploadFolder.$yeniDosyaAdi;

    if ($uploadOk == 0) {
        $message .= "Dosya Yüklenmedi.<br>";
    }else{
        if(move_uploaded_file($fileTempPath, $dest_path)){
            $message .="Dosya Yüklendi.<br>";
        }
    }


    return array(
        "isSuccess" => $uploadOk,
        "message" => $message,
        "image" => $yeniDosyaAdi
    );
}


function giveALike(int $blog_id, int $user_id){
    include "libs/database.php";

    $query = "INSERT INTO `blog_likes`(`blog_id`, `user_id`) VALUES (?, ?)";
    $result = mysqli_prepare($connection, $query);

    if (!mysqli_connect_errno()) {
        mysqli_stmt_bind_param($result, 'ii', $blog_id,$user_id);
        mysqli_stmt_execute($result);
        mysqli_close($connection);
    }
}




function isLike(){
    include "database.php";

    $query = "SELECT * FROM blog_likes";
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);

    return $result;
}


#is loggedin validation
function isLoggedin(){
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        return true;
    }else{
        return false;
    }
}
# admin validation
function isAdmin(){
    if (isLoggedin() && isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "admin") {
        return true;
    }else{
        return false;
    }
}




?>