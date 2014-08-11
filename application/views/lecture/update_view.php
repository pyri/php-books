<div class="col-md-9">
    <div class="jumbotron">
        <h2>Редактирование лекции</h2>

        <form role="form" method="post">
            <div class="form-group">
                <div class="lecture">

                    <label for="lecture_title">Название лекции</label>
                    <input type="text" class="form-control" name="lecture_title" id="lecture_title" value="<?php echo $lecture->title;?>">
                    <?=form_error('lecture_title');?>

                    <label for="lecture_content">Содержание лекции</label>
                    <textarea type="text" class="form-control" name="lecture_content" id="lecture_content" rows="15"><?php echo $lecture->content;?></textarea>
                    <?php echo form_ckeditor(array('id'=>'lecture_content')); ?>
                    <?=form_error('lecture_content');?>

                    <label for="lecture_questions">Вопросы для самопроверки</label>
                    <textarea type="text" class="form-control" name="lecture_questions" id="lecture_questions" rows="15"><?php echo $lecture->selfquestions;?></textarea>

                    <label for="lecture_example">Решение типовых примеров</label>
                    <textarea type="text" class="form-control" name="lecture_example" id="lecture_example" rows="15"><?php echo $lecture->example;?></textarea>

                    <label for="lecture_task">Задачи для самопроверки</label>
                    <textarea type="text" class="form-control" name="lecture_task" id="lecture_task" rows="15"><?php echo $lecture->task;?></textarea>

                    <label for="lecture_test">Прикрепите тест курса</label>
                    <select class="form-control" name="lecture_test" id="lecture_test">
                        <option value="0">Не выбрано</option>
                        <?php foreach ($allTests as $test): ?>
                            <option value="<?php echo $test->id; ?>"
                                <?php if($test->id == @$selectedTest->test_id){echo "selected";}?>>
                                <?php echo $test->title; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <input type="submit" class="btn btn-primary" name="update_lecture" value="Сохранить"/>
            <a href="<?= base_url(); ?>lecture/read/<?php echo $lecture->id;?>" class="btn btn-primary">Отмена</a>
        </form>
    </div>
</div>