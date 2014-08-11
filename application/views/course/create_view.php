<div class="col-md-9">
	
    <div class="jumbotron">
        <h2>Создание курса</h2>
        <form method="post">
            <div class="form-group">
                <label for="course_title">Название курса</label>
                <input type="text" name="course_title" class="form-control" id="course_title"
                       value=<?=set_value('course_title');?> >
				<?=form_error('course_title');?>

                <label for="course_author">Автор(-ы) курса</label>
                <input type="text" name="course_author" class="form-control" id="course_author"
                       value=<?=set_value('course_author');?> >
                <?=form_error('course_author');?>

                <label for="course_type">Тип учебного издания</label>
                <input type="text" name="course_type" class="form-control" id="course_type"
                       value=<?=set_value('course_type');?> >
                <?=form_error('course_type');?>

				<label for="course_test">Выберите тест курса</label>
                <select name="course_test" class="form-control" id="course_test">
					<option value="0">Не выбрано</option>
					<?php foreach ($tests as $test): ?>				
					<option value="<?php echo $test['test_id']; ?>"><?php echo $test['title']; ?></option>
					<?php endforeach; ?>
					<?=form_error('course_test');?>
				</select>                

                <label for="lecture_sources">Список использованных источников</label>
                <textarea type="text" name="course_source" class="form-control" id="lecture_sources"></textarea>
                <?php echo form_ckeditor(array('id'=>'lecture_sources')); ?>
                <?=form_error('course_source');?>
            </div>
				<input type="submit" class="btn btn-primary" name="add_course" value="Сохранить" />
                <a href="<?=base_url(); ?>lecture/create" class="btn btn-default">Создать лекцию</a>
                <a href="<?=base_url(); ?>/office" class="btn btn-default">Отмена</a>
        </form>
    </div>
</div>
