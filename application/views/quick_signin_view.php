<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Авторизация</title>
		<link href="<?= base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url(); ?>css/signin.css" rel="stylesheet" type="text/css" />	
	</head>
	<body>
		<div class="container">
			<form class="form-signin" method="post">
				<h2 class="form-signin-heading text-center">Авторизуйтесь</h2>
				<?php if(!empty($error_auth)):?>		
					<div class="alert alert-danger"><?php echo $error_auth; ?></div>
				<?php endif;?>
				<input type="text" name="username" class="form-control" placeholder="Пользователь" required="" autofocus="">
				<input type="password" name="password" class="form-control" placeholder="Пароль" required="">
				<input type="submit" class="btn btn-lg btn-primary btn-block" name="signin" value="Войти" />
			</form>
		</div>
	</body>
</html>