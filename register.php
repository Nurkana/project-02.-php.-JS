<?php 
	include "config/base_url.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Регистрация в систему</title>
    
	<?php include "views/head.php"; ?>
</head>
<body>

    <?php include "views/header.php"; ?>
    

	<section class="container page">
		<div class="auth-form">
            <h1>Регистрация</h1>
			<form class="form" action="<?=$BASE_URL?>/api/user/registration.php" method="POST">
                <fieldset class="fieldset">
                    <input class="input" type="text" name="email" placeholder="Введите email">
                </fieldset>
                <fieldset class="fieldset">
                    <input class="input" type="text" name="full_name" placeholder="Полное имя">
                </fieldset>
                <fieldset class="fieldset">
                    <input class="input" type="text" name="nickname" placeholder="Nickname">
                </fieldset>
                <fieldset class="fieldset">
                    <input class="input" type="password" name="password" placeholder="Введите пароль">
                </fieldset>
                <fieldset class="fieldset">
                    <input class="input" type="password" name="password2" placeholder="Подтвердить пароль">
                </fieldset>

                <fieldset class="fieldset">
                    <button class="button" type="submit">Зарегистрироваться</button>
                </fieldset>
			</form>
		</div>
	</section>
</body>
</html>