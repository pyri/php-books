
<div class="navbar navbar-inverse navbar-fixed-top header-color" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <h3 class="text-muted header-color">Приложение для создания электронных учебных ресурсов</h3>
        </div>
        <?php $session_user_id = $this->session->userdata('user_id');?>
        <?php $session_username = $this->session->userdata('username');?>
		<?php if(((uri_string() == '') or (uri_string() == 'logout') or (uri_string() == 'logout/index')) and (empty($session_user_id))):?>
			<div class="navbar-collapse collapse">
                <form class="navbar-form navbar-right" role="form" method="post">
                    <div class="form-group">
                        <input type="text" placeholder="Пользователь"
                               class="form-control" name="login_username">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Пароль"
                               class="form-control" name="login_password">

                    </div>
                    <input type="submit" class="btn btn-primary" name="enter" value="Войти" />
                </form>
            </div>
        <?php elseif(((uri_string() == '') or (uri_string() == 'logout') or (uri_string() == 'logout/index')) and (!empty($session_user_id))):?>

            <a href="<?=base_url();?>pages/logout" class="btn btn-primary padding-left-header">Выйти</a>
            <p class="navbar-right">Вы зашли под пользователем <a href="<?=base_url();?>office" class="align-white"><?php echo $session_username;?></a></p>
		<?php endif;?>
    </div>
</div>


