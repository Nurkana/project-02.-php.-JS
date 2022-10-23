    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style/all.css">
	<?php
		session_start();
	?>

	<script>
  		<?php if(isset($_SESSION["user_id"])){?>
    		localStorage.setItem("user_id", <?=$_SESSION["user_id"]?>)
  		<?php } else {?>
  			if(localStorage.getItem("user_id")) {
    		localStorage.removeItem("user_id")
  		}
  		<?php } ?>
	</script>