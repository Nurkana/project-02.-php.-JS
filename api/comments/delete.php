<?php
    include "../../config/db.php";
    if(isset($_GET["id"]) && intval($_GET["id"])){
        $id = $_GET["id"];
        mysqli_query($con,
        "DELETE FROM comments WHERE id=$id");
    }
?>