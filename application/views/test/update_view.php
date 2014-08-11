<div class="col-md-9">
    <div class="jumbotron">
        <h2>Редактирование теста "<?=$test->title;?>"</h2>
        <form method="post">
            <div class="form-group">
                <div class="well-sm">
                    <label for="test_title">Название теста</label>
                    <input type="text" class="form-control" name="test_title" id="test_title" value="<?=$test->title;?>">
                    <?=form_error('test_title');?>
                    <label for="test_course">Выберите курс, к которому следует прикрепить тест</label>
                    <select class="form-control" name="test_course" id="test_course">
                        <option value="0">Не выбрано</option>
                        <?php foreach ($allCourses as $course): ?>
                            <?php foreach ($selectedCourse as $selCourse): ?>
                                <option value="<?php echo $course['id']; ?>" <?php if($course['id'] == $selCourse['course_id']){echo "selected";}?>>
                                    <?php echo $course['title']; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        <?=form_error('test_course');?>
                    </select>

                    <label for="test_lecture">Выберите лекцию, к которой следует прикрепить тест</label>
                    <select class="form-control" name="test_lecture" id="test_lecture">
                        <option value="0">Не выбрано</option>
                        <?php foreach ($allLectures as $lecture): ?>
                            <?php foreach ($selectedLecture as $selLecture): ?>
                                <option value="<?php echo $lecture['id']; ?>" <?php if($lecture['id'] == $selLecture['lecture_id']){echo "selected";}?> >
                                    <?php echo $lecture['title']; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </select>
                    <?=form_error('test_lecture');?>
                </div>

                <div class="well-sm">
                    <?php foreach ($questions_multiple as $key => $question):;?>
                        <br/><h4><?=$question['title'];?></h4>
                        <a href="<?=base_url(); ?>question/updateMultiple/<?php echo $question['id']; ?>" class="btn btn-default">Редактировать</a>
                        <a href="<?=base_url(); ?>question/del/<?php echo $question['id']; ?>" class="btn btn-default" onclick="return confirmDelete();">Удалить</a>

                        <?php foreach ($question['answers'] as $answer):?>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="checkbox" name="checkbox" id="checkbox" disabled
                                        <?php if($answer['right'] == 1){echo 'checked';}?>>
                                </span>
                                <p class="label-grey"><?=$answer['option'];?></p>
                            </div>
                        <?php endforeach;
                    endforeach;?>

                    <?php foreach ($questions_single as $key => $question):?>
                        <br/><h4><?=$question['title'];?></h4>
                        <a href="<?=base_url(); ?>question/updateSingle/<?php echo $question['id']; ?>" class="btn btn-default">Редактировать</a>
                        <a href="<?=base_url(); ?>question/del/<?php echo $question['id']; ?>" class="btn btn-default" onclick="return confirmDelete();">Удалить</a>

                        <input type="text" class="form-control" value="<?=$question['answer']?>">
                    <?php endforeach;?>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" name="update_test" value="Сохранить" />
            <a href="<?=base_url(); ?>question/create/" class="btn btn-default">Добавить вопросы</a>
            <a href="<?=base_url(); ?>test/read/<?php echo $test->id; ?>" class="btn btn-default">Отмена</a>
        </form>
    </div>
</div>