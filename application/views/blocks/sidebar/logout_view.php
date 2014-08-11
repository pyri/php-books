<div class="col-md-3">
	<div class="well sidebar-nav">
		<h3>Регистрация:</h3>
		<?php if(!empty($error_password)):?>		
			<div class="alert alert-danger"><?php echo $error_password; ?></div>
		<?php endif;?>
		<?php if(!empty($error_login)):?>		
			<div class="alert alert-danger"><?php echo $error_login; ?></div>
		<?php endif;?>		
		<?php if(!empty($success)):?>
			<div class="alert alert-success"><?php echo $success; ?></div>
		<?php endif;?>
		<form role="form" method="post">
			<div class="form-group">
				<label for="exampleInputEmail1">Пользователь</label>
				<input type="text" class="form-control" id="exampleInputEmail1"
                       name="reg_username" value=<?=set_value('reg_username');?>>
				<?=form_error('reg_username');?>
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Пароль</label>
				<input type="password" class="form-control" id="exampleInputPassword1"
                       name="reg_password" value=<?=set_value('reg_password');?>>
				<?=form_error('reg_password');?>
			</div>
			<div class="form-group">
				<label for="exampleInputPassword2">Повторите пароль</label>
				<input type="password" class="form-control" id="exampleInputPassword2"
                       name="reg_password_again" value=<?=set_value('reg_password_again');?>>
				<?=form_error('reg_password_again');?>
			</div>
			<input type="submit" class="btn btn-primary" name="registration"
                   value="Регистрация" />
		</form>
	</div>
</div>