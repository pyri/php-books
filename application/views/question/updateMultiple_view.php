<h3>Редактирование вопроса из теста "<?=$test->title?>"</h3>
<?php if (!empty($msg_error)) :?>
    <div class="alert alert-danger"><?=$msg_error; ?></div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label for="question_multiple">Вопрос</label>
        <textarea type="text" class="form-control" name="question_multiple" id="question_multiple" rows="2"><?php echo $question->title; ?></textarea>
        <label>Укажите варианты ответа, галочкой пометьте верные</label>
        <?=form_error('question_multiple');?>

        <?php $i=0?><!--Вывод заполненный полей для ответов-->
        <?php foreach($answers as $answer):?>
            <?php $i++?>
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="checkbox" name="answer[<?=$i;?>][right]" <?php if($answer->right == 1){echo 'checked';}?>>
                 </span>
                <input type="text" class="form-control" name="answer[<?=$i;?>][option]" id="answer_multiple" value="<?php echo $answer->option;?>">
            </div>
        <?php endforeach;?>

        <?php  while ($i != 5):?><!--Вывод незаполненный полей для ответов-->
        <?php $i++;?>
            <div class="input-group">
                    <span class="input-group-addon">
                        <input type="checkbox" name="answer[<?=$i;?>][right]">
                     </span>
                <input type="text" class="form-control" name="answer[<?=$i;?>][option]" id="answer_multiple">
            </div>
        <?php endwhile;?>
        <span class="help-block">Заполните необходимое Вам количество полей для ответов</span>

    </div>
    <input type="submit" class="btn btn-primary" name="update_question" value="Сохранить" />
    <a href="<?=base_url(); ?>test/update/<?php echo $test->id; ?>" class="btn btn-default">Отмена</a>
</form>

