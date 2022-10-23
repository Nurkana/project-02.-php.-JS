<?php
 include "../../config/db.php";
 include "../../config/base_url.php";

 $id = $_GET["id"];

 if(isset($_GET["id"], $_POST["title"], $_POST["description"], $_POST["category_id"]) &&
 intval($_GET["id"]) &&
 intval($_POST["category_id"])&&
 strlen($_POST["title"]) > 0 &&
 strlen($_POST["description"]) > 0 ){
    $cat = $_POST["category_id"];
    $title = $_POST["title"];
    $desc = $_POST["description"];

    session_start();
    $user_id = $_SESSION["user_id"];

    if(isset($_FILES["image"], $_FILES["image"]["name"])){
        $query = mysqli_query($con,
        "SELECT img FROM blogs WHERE id=$id");
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
            $old_path = "../..".$row["img"];
            if(file_exists($olf_path)){
                unlink($old_path);
            }
        }
        $ext = end(explode(".", $_FILES["image"]["name"]));
        $image_name = time().".".$ext;
        move_uploaded_file($_FILES["image"]["tmp_name"], "../../images/blogs/$image_name");
        $path = "/images/blogs/".$image_name;

        $prep = mysqli_prepare($con,
        "UPDATE blogs SET title=?, description=?, category_id=?, img=?
        WHERE id=? AND author_id=?");
        mysqli_stmt_bind_param($prep, "ssisii", $title, $desc, $cat, $path, $id, $user_id);
        mysqli_stmt_execute($prep);
    }else{
        $prep = mysqli_prepare($con,
        "UPDATE blogs SET title=?, description=?, category_id=?
        WHERE id=? AND author_id=?");
        mysqli_stmt_bind_param($prep, "ssiii", $title, $desc, $cat, $id, $user_id);
        mysqli_stmt_execute($prep);
    }

    header("location:$BASE_URL/profile.php?nickname=".$_SESSION["nickname"]);


 }else{
    header("location:$BASE_URL/editblog.php?error=1&id=$id");
 }
?>