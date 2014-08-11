<div class="col-md-9">
    <div class="jumbotron">

    <h2>Создание лекции</h2>

	<form role="form" method="post">
		<div class="form-group">
		
			<label for="lecture_content">Содержание лекции</label>
			<textarea type="text" name="lecture_content" class="form-control" id="lecture_content" rows="15"></textarea>
			
			<label for="lecture_questions">Вопросы для самопроверки</label>
			<textarea type="text" name="lecture_selfquestions" class="form-control" id="lecture_questions" rows="15"></textarea>
			
			<label for="lecture_example">Решение типовых примеров</label>
			<textarea type="text" name="lecture_examples" class="form-control" id="lecture_example" rows="15"></textarea>

			<label for="lecture_tasks">Задачи для самопроверки</label>
			<textarea type="text" name="lecture_tasks" class="form-control" id="lecture_tasks" rows="15"></textarea>

			<label for="lecture_test">Прикрепите тест</label>
			<select name="lecture_test" class="form-control" id="lecture_test">
				<option>Не выбрано</option>
				<?php foreach ($tests as $test): ?>				
				<option value="<?php echo $test->id; ?>"><?php echo $test->title; ?></option>				
				<?php endforeach; ?>
			</select>
			
			<label for="lecture_couse">Выберите курс</label>
            <select name="lecture_course" class="form-control" id="lecture_couse"> 
                <?php foreach ($courses as $course): ?>				
					<option value="<?php echo $course->id; ?>">
						<?php echo $course->title; ?>
					</option>				
				<?php endforeach; ?>
            </select>
			
            <label for="lecture_title">Название лекции</label>
            <input type="text" name="lecture_title" class="form-control" id="lecture_title">
			
		</div>
		<input type="submit" class="btn btn-primary" name="add_lecture_content" value="Следующий шаг" />
	</form>
</div>
</div>

</div>
</div>
<hr>