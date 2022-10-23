<?php
    include "../../config/base_url.php";
    include "../../config/db.php";

    $data = json_decode(file_get_contents("php://input"),true);
    if(isset($data["text"], $data["blog_id"])&&
    strlen($data["text"]) > 0 &&
    intval($data["blog_id"])){
        $text = $data["text"];
        $blog_id = $data["blog_id"];
        session_start();
        $author = $_SESSION["user_id"];

        $prep = mysqli_prepare($con,
        "INSERT INTO comments(text, author_id, blog_id)
        VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($prep, "sii", $text, $author, $blog_id);
        mysqli_stmt_execute($prep);
    }
?>