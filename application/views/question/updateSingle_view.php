<h3>Редактирование вопроса из теста "<?=$test->title?>"</h3>

<form method="post">
    <div class="form-group">
        <label for="question_single">Вопрос</label>
        <textarea type="text" class="form-control" name="question_single" id="question_single" rows="2"><?php echo $question->title;?></textarea>
        <?=form_error('question_single');?>

        <label for="answer_without_option">Ответ</label>
        <textarea type="text" class="form-control" name="answer_without_option" id="answer_without_option" rows="1"><?php echo $answer['0']->without_option; ?></textarea>
        <?=form_error('answer_without_option');?>
    </div>
    <input type="submit" class="btn btn-primary" name="update_question" value="Сохранить" />
    <a href="<?=base_url(); ?>test/update/<?php echo $test->id; ?>" class="btn btn-default">Отмена</a>
</form>
