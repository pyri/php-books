<div class="col-md-9">
    <div class="jumbotron">

    <h2>Создание лекции</h2>

    <ul class="nav nav-pills">
		<li><a href="<?=base_url();?>lecture/create_title">Название</a></li>
		<li><a href="<?=base_url();?>lecture/create_content">Содержание</a></li>
		<li class="active"><a href="<?=base_url();?>lecture/create_tasks">Задачи</a></li>
	</ul>

	<form role="form" method="post">
		<div class="form-group">
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
		</div>
		<input type="submit" class="btn btn-primary" name="add_lecture_tasks" value="Создать лекцию" />
	</form>
</div>
</div>

</div>
</div>
<hr>