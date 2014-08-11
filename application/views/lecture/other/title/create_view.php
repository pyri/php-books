<div class="col-md-9">
    <div class="jumbotron">

    <h2>Создание лекции</h2>

    <ul class="nav nav-pills">
        <li class="active"><a href="<?=base_url();?>lecture/create_title">Название</a></li>
        <li><a href="<?=base_url();?>lecture/create_content">Содержание</a></li>
        <li><a href="<?=base_url();?>lecture/create_tasks">Задачи</a></li>
    </ul>

    <form role="form" method="post">
        <div class="form-group">
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
        <input type="submit" class="btn btn-primary" name="add_lecture_title" value="Следующий шаг" />
    </form>
</div>
</div>

</div>
</div>
<hr>