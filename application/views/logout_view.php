 <div class="col-md-9">
	<?php if(!empty($error_auth)):?>		
		<div class="alert alert-danger"><?php echo $error_auth; ?></div>
	<?php endif;?>
	<div class="jumbotron">
		<h1>Здравствуйте!</h1>
		<p>
            Вас приветвствует приложение по созданию учебных элекронных курсов.
            Здесь Вы найдете средства для создания собственных курсов и лекций
            по различным областям науки. Также к своим курсам Вы сможете прикрепить
            самостоятельно созданные тесты, задачи, типовые примеры и
            вопросы для самопроверки.
		</p>
	</div>

	<div class="row">
		<div class="col-md-9">
			<h2>Созданные курсы:</h2>
			<ul class="nav nav-list">
                <?php foreach($courses as $course):?>
				<li>
					<a href="<?=base_url();?>courseUnAuth/read/<?=$course->id;?>">
                        <?=$course->title;?>
                    </a>
					<p><?=$course->description;?></p>
				</li>
				<?php endforeach;?>
			</ul>
            <h2>Созданные тесты:</h2>
            <ul class="nav nav-list">
                <?php foreach($tests as $test):?>
                    <li>
                        <a href="<?=base_url();?>testUnAuth/read/<?=$test->id;?>">
                            <?=$test->title;?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
		</div>
	</div>
 </div>