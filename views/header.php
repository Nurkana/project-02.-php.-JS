<header class="header container">
	<div class="header-logo">
		<div><img class="format" src="images/format.jpg" alt=""></div>
	    <a href="index.php">Live Now</a>	
	</div>
	<form class="header-search" method="GET">
		<input type="text" class="input-search" name="q" placeholder="Поиск по блогам">
		<button class="button button-search">
			<img src="images/search.svg" alt="">	
			Найти
		</button>
</form>
	<div>
		<?php
			if(isset($_SESSION["nickname"])){
		?>
        <a href="profile.php?nickname=<?=$_SESSION["nickname"]?>">
            <img class="avatar" src="images/avatar.png" alt="Avatar">
			<h2><?=$_SESSION["full_name"]?></h2>
        </a>
		<?php
			}else{
		?>

        <div class="button-group">
            <a href="<?=$BASE_URL?>/register.php" class="button">Регистрация</a>
            <a href="<?=$BASE_URL?>/login.php" class="button">Вход</a>
        </div>
		<?php
			}
		?>

		
	</div>
</header>