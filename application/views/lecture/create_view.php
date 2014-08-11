<div class="col-md-9">
    <div class="jumbotron">

    <h2>Создание лекции</h2>

	<form role="form" method="post">
		<div class="form-group">			
			<fieldset>
				<legend><a>Основное</a></legend>
				<div class="inserted">
					<label for="lecture_couse">Выберите курс</label>
					<select name="lecture_course" class="form-control" id="lecture_couse"> 
						<?php foreach ($courses as $course): ?>				
							<option value="<?php echo $course->id; ?>" <?php if($course->id == $course->id){echo "selected";}?>>
								<?php echo $course->title; ?>
							</option>
						<?php endforeach; ?>
						<?=form_error('lecture_course');?>
					</select>
							
					<label for="lecture_title">Название лекции</label>
					<input type="text" name="lecture_title" class="form-control" id="lecture_title" value="<?=set_value('lecture_title');?>">
					<?=form_error('lecture_title');?>
				</div>
			</fieldset>
		
			<fieldset>
				<legend><a>Содержание</a></legend>
				<div class="inserted">
					<label for="lecture_content">Содержание лекции</label>
					<textarea type="text" name="lecture_content" class="form-control" id="lecture_content" rows="15">
                        <?=set_value('lecture_content');?>
                    </textarea>
                    <?php echo form_ckeditor(array('id'=>'lecture_content')); ?>
                    <?=form_error('lecture_content');?>
					
					<label for="lecture_questions">Вопросы для самопроверки</label>
					<textarea type="text" name="lecture_selfquestions" class="form-control" id="lecture_questions" rows="15"><?=set_value('lecture_selfquestions');?></textarea>
                    <?=form_error('lecture_selfquestions');?>
				</div>
			</fieldset>	
			
			<fieldset>
				<legend><a>Задачи</a></legend>
				<div class="inserted">				
					<label for="lecture_example">Решение типовых примеров</label>
					<textarea type="text" name="lecture_examples" class="form-control" id="lecture_example" rows="15"><?=set_value('lecture_examples');?></textarea>
                    <?=form_error('lecture_examples');?>
					
					<label for="lecture_task">Задачи для самопроверки</label>
					<textarea type="text" name="lecture_task" class="form-control" id="lecture_task" rows="15"><?=set_value('lecture_tasks');?></textarea>
                    <?=form_error('lecture_tasks');?>
					
					<label for="lecture_test">Прикрепите тест</label>
					<select name="lecture_test" class="form-control" id="lecture_test">
						<option>Не выбрано</option>
						<?php foreach ($tests as $test): ?>				
						<option value="<?php echo $test->id; ?>"><?php echo $test->title; ?></option>				
						<?php endforeach; ?>
						<?=form_error('course_title');?>
					</select>
				</div>
			</fieldset>
		</div>
		<input type="submit" class="btn btn-primary" name="add_lecture" value="Создать лекцию" />
        <a href="<?=base_url(); ?>/office" class="btn btn-default">Отмена</a>
	</form>
</div>
</div>
