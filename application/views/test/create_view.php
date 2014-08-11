<div class="col-md-9">
            <div class="jumbotron">
                <h2>Создание теста</h2>
                <form role="form" method="post">
                    <div class="form-group">
                        <label for="test_title">Название теста</label>
                        <input type="text" name="test_title" class="form-control" id="test_title" value=<?=set_value('test_title');?>>
						<?=form_error('test_title');?>
						
                        <label for="test_course">Выберите курс, к которому необходимо прикрепить тест</label>
                        <select name="test_course" class="form-control" id="test_course">
							<option>Не выбрано</option>
                            <?php foreach ($courses as $course): ?>				
								<option value="<?php echo $course->id; ?>">
									<?php echo $course->title; ?>
								</option>				
							<?php endforeach; ?>
						<?=form_error('test_course');?>
                        </select>
						
                        <label for="test_lecture">Выберите лекцию, к котороой необходимо прикрепить тест</label>
                        <select name="test_lecture" class="form-control" id="test_lecture">
							<option>Не выбрано</option>
                            <?php foreach ($lectures as $lecture): ?>				
								<option value="<?php echo $lecture->id; ?>">
									<?php echo $lecture->title; ?>
								</option>				
							<?php endforeach; ?>
						<?=form_error('test_lecture');?>
                        </select>
                    </div>
					<input type="submit" class="btn btn-primary" name="add_test" value="Сохранить" />
					<a href="<?=base_url(); ?>question/create" class="btn btn-default">Добавить вопросы</a>
                    <a href="<?=base_url(); ?>/office" class="btn btn-default">Отмена</a>
                </form>
            </div>
        </div>
