<?php
    include "../../config/base_url.php";
    include "../../config/db.php";
    

    if(isset($_POST["email"], $_POST["nickname"], $_POST["full_name"]) &&
    strlen($_POST["email"]) > 0 &&
    strlen($_POST["nickname"]) > 0 &&
    strlen($_POST["full_name"]) > 0 ){
        $email = $_POST["email"];
        $nickname = $_POST["nickname"];
        $full_name = $_POST["full_name"];
        session_start();
            $id = $_SESSION["user_id"];
            $userquery = mysqli_query($con,
            "SELECT * FROM users WHERE id=$id");
            $user = mysqli_fetch_assoc($userquery);
        
        if(isset($_POST["password"], $_POST["new_password"], $_POST["about"]) &&
            strlen($_POST["password"]) > 0 &&
            strlen($_POST["new_password"]) > 0 &&
            strlen($_POST["about"]) > 0 ){
                if(sha1($_POST["password"]) == $user["password"]){
                    $newpas = sha1($_POST["new_password"]);
                    $prep = mysqli_prepare($con,
                    "UPDATE users SET nickname=?, email=?, full_name=?, password=?, about=?
                    WHERE id=?");
                    mysqli_stmt_bind_param($prep, "sssssi", $nickname, $email,$full_name, $newpas, $_POST["about"], $user["id"]);
                    mysqli_stmt_execute($prep);
                    $_SESSION["nickname"] = $_POST["nickname"];
                }else{
                header("Location:$BASE_URL/updateUser.php?error=2");

                }
            }

            elseif(isset($_POST["password"], $_POST["new_password"])&&
            strlen($_POST["password"]) > 0 &&
            strlen($_POST["new_password"]) > 0){
                if(sha1($_POST["password"]) == $user["password"]){
                    $newpas = sha1($_POST["new_password"]);
                    $prep = mysqli_prepare($con,
                    "UPDATE users SET nickname=?, email=?, full_name=?, password=?
                    WHERE id=?");
                    mysqli_stmt_bind_param($prep, "ssssi", $nickname, $email, $full_name, $newpas, $user["id"]);
                    mysqli_stmt_execute($prep);
                    $_SESSION["nickname"] = $_POST["nickname"];

                }else{
                    header("Location:$BASE_URL/updateUser.php?error=2");

                }
            }

            elseif(isset($_POST["about"]) &&
            strlen($_POST["about"]) > 0){
                $prep = mysqli_prepare($con,
                "UPDATE users SET nickname=?, email=?, full_name=?, about=?
                WHERE id=?");
                mysqli_stmt_bind_param($prep, "ssssi", $nickname, $email, $full_name, $_POST["about"], $user["id"]);
                mysqli_stmt_execute($prep);
                $_SESSION["nickname"] = $_POST["nickname"];

            }else{
                $prep = mysqli_prepare($con,
                "UPDATE users SET nickname=?, email=?, full_name=?
                WHERE id=?");
                mysqli_stmt_bind_param($prep, "sssi", $nickname, $email, $full_name,  $user["id"]);
                mysqli_stmt_execute($prep);
                $_SESSION["nickname"] = $_POST["nickname"];

            }
        header("Location:$BASE_URL/profile.php");
    }else{
        header("Location:$BASE_URL/updateUser.php?error=1");
    }

?>