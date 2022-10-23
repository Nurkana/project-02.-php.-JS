<?php 
	include "config/base_url.php";
	include "config/db.php";
	include "common/time.php";

	if(isset($_GET["nickname"])){
		$prep = mysqli_prepare($con,
		"SELECT b.*, u.nickname, c.name FROM blogs b
		LEFT OUTER JOIN users u ON u.id=b.author_id
		LEFT OUTER JOIN categories c ON c.id=b.category_id
		WHERE u.nickname =?");
		mysqli_stmt_bind_param($prep, "s", $_GET['nickname']);
		mysqli_stmt_execute($prep);
		$blogs = mysqli_stmt_get_result($prep);
	}else{
		header("Location: $BASE_URL/index.php");
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Профиль</title>
	
	<?php include "views/head.php"; ?>
</head>
<body>

	<?php include "views/header.php"; ?>

<section class="container page">
	<div class="page-content">
		<div class="page-header">
			<?php
				$user_prep = mysqli_prepare($con,
				"SELECT * FROM users WHERE nickname=?");
				mysqli_stmt_bind_param($user_prep, "s", $_GET["nickname"]);
				mysqli_stmt_execute($user_prep);
				$user_info = mysqli_stmt_get_result($user_prep);
				$user = mysqli_fetch_assoc($user_info);
				if($user["nickname"] == $_SESSION["nickname"]){
			?>
				<h2>Мои блоги</h2>
				<a class="button" href="newblog.php">Новый блог</a>
			<?php
				}else{
			?>
				<h2>Блоги<?=$user["nickname"]?></h2>
			<?php
				}
			?>
		</div>

		<div class="blogs">
			
			<?php
				if(mysqli_num_rows($blogs) > 0){
					while($blog = mysqli_fetch_assoc($blogs)){
			?>
			<div class="blog-item">
				<img class="blog-item--img" src="<?=$BASE_URL?><?=$blog["img"]?>" alt="">
				<div class="blog-header">
					<h3><a href="<?=$BASE_URL?>/blog-details.php?id=<?=$blog["id"]?>"><?=$blog["title"]?></a></h3>
					<?php
						if($blog["nickname"] == $_SESSION["nickname"]){
					?>
					<span class="link">
						<img src="images/dots.svg" alt="">
						Еще

						<ul class="dropdown">
							<li> <a href="<?=$BASE_URL?>/editblog.php?id=<?=$blog["id"]?>">Редактировать</a> </li>
							<li><a href="<?=$BASE_URL?>/api/blog/delete.php?id=<?=$blog["id"]?>" class="danger">Удалить</a></li>
						</ul>
					</span>
					<?php
						}
					?>
				</div>
				<p class="blog-desc"><?=$blog["description"]?></p>

				<div class="blog-info">
					<span class="link">
						<img src="images/date.svg" alt="">
						<?=to_time_ago(strtotime($blog["date"]))?>
						<!-- to_time_ago показывает как давно загрузился файл -->
					</span>
					<span class="link">
						<img src="images/visibility.svg" alt="">
						21
					</span>
					<a class="link">
						<img src="images/message.svg" alt="">
						4
					</a>
					<span class="link">
						<img src="images/forums.svg" alt="">
						<?=$blog["name"]?>
					</span>
					<a class="link">
						<img src="images/person.svg" alt="">
						<?=$blog["nickname"]?>
					</a>
				</div>
			</div>

			<?php
				}
			}else{
			?>
			
				<h1>0 blogs</h1>
			<?php
				}
			?>

		</div>
	</div>
	<div class="page-info">
		<div class="user-profile">
			<img class="user-profile--ava" src="images/avatar.png" alt="">

			<h1><?=$_SESSION["full_name"]?></h1>
			<h2><?=$user["about"]?></h2>
			<p><?=mysqli_num_rows($blogs)?> постов за все время</p>
			<a href="<?=$BASE_URL?>/updateUser.php" class="button">Редактировать</a>
			<a href="<?=$BASE_URL?>/api/user/signout.php" class="button button-danger"> Выход</a>
		</div>
	</div>
</section>	
</body>
</html>