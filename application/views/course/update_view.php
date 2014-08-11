<div class="col-md-9">
    <div class="jumbotron">
        <h2>Редактирование курса</h2>

        <form method="post">
            <div class="form-group">
                <label for="course_title">Название курса</label>
                <input type="text" name="course_title" class="form-control" id="course_title"
                       value="<?php echo $course->title;?>">
                <?=form_error('course_title');?>

                <label for="course_author">Автор курса</label>
                <input type="text" name="course_author" class="form-control" id="course_author"
                       value="<?php echo $course->author;?>">
                <?=form_error('course_author');?>

                <label for="course_type">Тип учебного издания</label>
                <input type="text" name="course_type" class="form-control" id="course_type"
                       value="<?php echo $course->type_of_publication;?>">
                <?=form_error('course_type');?>

                <label for="lecture_test2">Прикрепите тест курса</label>

                <select class="form-control"  name="course_test" id="course_test">
                    <option value="0">Не выбрано</option>
                    <?php foreach ($testsAll as $test): ?>
                        <option value="<?php echo $test->id; ?>" <?php if($test->course_id == $testSel[0]['course_id']){echo "selected";}?>>
                            <?php echo $test->title; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="lecture_sources2">Список использованных источников</label>
                <textarea type="text" name="course_source" class="form-control" id="course_source">
                    <?php echo $course->source;?>
                </textarea>
                <?php echo form_ckeditor(array('id'=>'course_source')); ?>
            </div>
            <input type="submit" class="btn btn-primary" name="update_course" value="Сохранить" />
            <a href="<?=base_url(); ?>lecture/create" class="btn btn-default">Добавить лекцию</a>
            <a href="<?=base_url(); ?>course/read/<?php echo $course->id; ?>" class="btn btn-default">Отмена</a>
        </form>
    </div>
</div>