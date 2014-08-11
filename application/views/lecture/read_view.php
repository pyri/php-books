<div class="col-md-9">
    <div class="btn-group">
        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
            Действия<span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="<?=base_url(); ?>lecture/update/<?=$lecture_id;?>">Редактировать лекцию</a></li>
            <li><a href="<?=base_url(); ?>lecture/create">Добавить лекцию</a></li>
            <li><a href="<?=base_url()?>lecture/del/<?=$lecture_id;?>" onclick="return confirmDelete();">Удалить лекцию</a></li>

        </ul>
    </div>

    <form method="post" class="my-inline">
        <input type="submit" name="pdf_lecture" class="btn btn-default" value="Создать pdf-копию">
    </form>

    <?php if (!empty($msg)) :?>
        <div class="alert alert-success"><?=$msg; ?></div>
    <?php endif; ?>

	<div class="lecture">				
		<h3 class="text-center"><?php echo $lecture->title;?></h3>
		<p><?php echo $lecture->content;?></p>

        <?php if(!empty($lecture->selfquestions)):?>
            <h3>Вопросы для самопроверки</h3>
            <p><?php echo $lecture->selfquestions;?></p>
        <?php endif;?>

        <?php if(!empty($lecture->example)):?>
            <h3>Примеры</h3>
            <p><?php echo $lecture->example;?></p>
        <?php endif;?>

        <?php if(!empty($lecture->task)):?>
            <h3>Задачи</h3>
            <p><?php echo $lecture->task;?></p>
        <?php endif;?>

        <?php if(!empty($test->title)):?>
            <h3><a href="<?=base_url();?>test/read/<?=$test->test_id;?>">Тест "<?php echo $test->title;?>"</a></h3>
        <?php endif;?>
	</div>
</div>
