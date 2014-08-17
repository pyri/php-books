<div class="col-md-9">
    <div class="btn-group">
        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
            Действия<span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="<?=base_url(); ?>course/update/<?=$course_id;?>">Редактировать курс</a></li>
            <li><a href="<?=base_url(); ?>lecture/create">Добавить лекцию</a></li>
            <li><a href="<?=base_url()?>course/del/<?=$course_id;?>" onclick="return confirmDelete();">Удалить курс</a></li>
        </ul>
    </div>
    <form method="post" class="my-inline">

        <?php $lecture_title='';?>

        <?php foreach($course as $item):
            $lecture_title=$lecture_title.$item['l_title'];
            $sourse = $item['c_source'];
        endforeach;?>

        <?if(!empty($lecture_title) or !empty($sourse)):?>
            <input type="submit" name="pdf_course" class="btn btn-default" value="Создать pdf-копию">
        <?php endif;?>

        <?if(!empty($lecture_title)):?>
            <input type="submit" name="course_publish" class="btn btn-default" value="Опубликовать курс" onclick="return confirmDelete();">
        <?php endif;?>

    </form>


    <?php if (!empty($msg_success)):?>
        <div class="alert alert-success"><?=$msg_success; ?></div>
    <?php elseif (!empty($msg_error)):?>
       <div class="alert alert-danger"><?=$msg_error; ?></div>
    <?php endif; ?>
	<div class="lecture">

        <h1 class="text-center text-primary"><?php echo $course['0']['c_title'];?></h1>
        <h4>Автор(-ы) курса: <?php echo $course['0']['c_author'];?></h4>
        <h4>Тип учебного издания: <?php echo $course['0']['c_type'];?></h4>
        <h3>Содержание курса</h3>
		<ul>
		<?php foreach ($course as $item): ?>
			<li>
                <a href="<?=base_url();?>lecture/read/<?php echo $item['l_id']; ?>">
                    <?php
                        echo $item['l_title'];
                        $listLectures = '';
                        $listLectures = $listLectures.$item['l_title'];
                    ?>
                </a>
            </li>
		<?php endforeach;
        if(empty($listLectures)):?>
            <blockquote class="panel-warning bg-warning">
                <p>Для данного курса не создано лекций!</p>
            </blockquote>
        <?php endif;?>
		</ul>


        <?php if(!empty($course['0']['c_source'])):?>
            <h3>Список используемой литературы</h3>
            <?php echo $course['0']['c_source']; ?>
        <?php endif;?>

        <?php if(!empty($test)):?>
            <h3><a href="<?=base_url()?>test/read/<?=$test[0]['test_id']?>">Тест "<?php echo $test[0]['title']; ?>"</a></h3>
        <?php endif;?>
	</div>
</div>