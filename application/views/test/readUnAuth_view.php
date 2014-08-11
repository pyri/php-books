<div class="col-md-9">
    <a href="<?=base_url()?>">Главная страница</a>
    <div>
        <form method="post">
            <div class="form-group">
                <h2><?php echo $test->title;?></h2>

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
                $i = 0;
                foreach ($questions_multiple as $key => $question) {
                    echo '<br/><h4>' . $question['title'] . '</h4>';

                    foreach ($question['answers'] as $answer) { ?>
                        <div class="input-group">
                            <span class="input-group-addon">

                                <input type="checkbox" name="checkbox<?=$answer['question_id'];?>[]" value="<?=$answer['id'];?>">
                            </span>
                            <p class="label-white"><?=$answer['option'];?></p>
                        </div>
                    <?
                    }
                }?>

                <?php foreach ($questions_single as $question):?>
                    <div class="well-sm">
                        <h4><?php echo $question['title'];?></h4>
                        <input type="text" name="answerQuestionSingle<?=$question['id'];?>" class="form-control">
                    </div>
                <?php endforeach; ?>
            </div>
            <input type="submit" class="btn btn-primary" name="test_end" value="Завершить" />
        </form>
    </div>
</div>