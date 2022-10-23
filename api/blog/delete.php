<?php
include "../../config/db.php";
include "../../config/base_url.php";

if(isset($_GET["id"])){
    session_start();
    $prep = mysqli_prepare($con,
    "DELETE FROM blogs WHERE id = ?");
    mysqli_stmt_bind_param($prep, "i", $_GET["id"]);
    mysqli_stmt_execute($prep);

    header("Location:$BASE_URL/profile.php?nickname=".$_SESSION["nickname"]);

}else{
    header("Location:$BASE_URL/index.php");
}
?>