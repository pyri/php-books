<div class="col-md-9">

    <div class="btn-group">
        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
            Действия<span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="<?=base_url(); ?>question/create">Добавить вопросы</a></li>
            <li><a href="<?= base_url(); ?>test/update/<?= $test->id; ?>">Редактировать тест</a></li>
            <li><a href="<?= base_url(); ?>test/del/<?= $test->id; ?>"onclick="return confirmDelete();">Удалить тест</a></li>

        </ul>
    </div>

    <form method="post" class="my-inline">
        <?if(!empty($question_single) or !empty($questions_multiple)):?>
            <input type="submit" name="pdf_test" class="btn btn-default" value="Создать pdf-копию">
            <input type="submit" name="test_publish" class="btn btn-default" value="Опубликовать тест" onclick="return confirmDelete();">
        <?php endif;?>
    </form>


    <?php if (!empty($msg)) :?>
        <div class="alert alert-success"><?=$msg; ?></div>
    <?php endif; ?>
    <div>
        <form method="post">
            <div class="form-group">
                <h2 class="text-center"><?php echo $test->title; ?></h2>

                <?php if (!empty($msgTestControl)) :?>
                    <div class="alert alert-danger"><?php echo $msgTestControl; ?></div>
                <?php endif; ?>

                <?php if ($countRightAnswers != -1) :?>
                    <div class="alert alert-info">
                        Количество верных ответов:  <?php echo $countRightAnswers; ?><br />

                        <?php if (!empty($wrongAnswerForQuestion)) :?>
                        Вы допустили ошибки в вопросах:
                        <ul>
                            <?php foreach($wrongAnswerForQuestion as $wrongAnswer):?>
                                <li><?=$wrongAnswer;?></li>
                            <?php endforeach?>
                        </ul>
                        <?php endif?>
                    </div>
                <?php endif; ?>

                <?php
                foreach ($questions_multiple as $key => $question):
                    echo '<br/><h4>' . $question['title'] . '</h4>';
                    foreach ($question['answers'] as $answer):?>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="checkbox" name="checkbox<?=$answer['question_id'];?>[]" value="<?=$answer['id'];?>">
                            </span>
                            <p class="label-white"><?=$answer['option'];?></p>
                        </div>
                    <? endforeach;
                endforeach; ?>


                <?php $j = 0;
                foreach ($questions_single as $question): ?>
                    <div class="well-sm">
                        <h4><?php echo $question['title'];
                            $j++; ?></h4>
                        <input type="text" name="answerQuestionSingle<?=$question['id'];?>" class="form-control">
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if(empty($questions_multiple) and empty($questions_single)) :?>
                <blockquote class="panel-warning bg-warning">
                    <p>Для данного теста не создано вопросов!</p>
                </blockquote>
            <?php else:?>
                <input type="submit" class="btn btn-primary" name="test_end" value="Завершить"/>
            <?php endif;?>
        </form>
    </div>
</div>