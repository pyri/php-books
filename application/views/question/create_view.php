<div class="col-md-9">
            <div class="jumbotron">
                <h2>Создание вопросов</h2>
                <?php if(!empty($msg->error)):?>
                    <p class="alert alert-danger"><?php echo $msg->error;?></p>
                <?php elseif(!empty($msg->success)):?>
                    <p class="alert alert-success"><?php echo $msg->success;?></p>
                <?php endif;?>
                <form role="form" method="post">
                    <div class="form-group">
                        <div class="well-lg">
                            <label for="question_test">Название теста</label>
                            <select name="test_title" class="form-control" id="question_test">
								<?php foreach ($tests as $test): ?>				
								<option value="<?php echo $test->id; ?>"><?php echo $test->title; ?></option>				
								<?php endforeach; ?>
								<?=form_error('test_title');?>
                            </select>
                        </div>

                        <div class="well-lg">
                            <label for="question_title">Вопрос с множественным выбором</label>
                            <textarea type="text" name="question_multiple" class="form-control" id="question_title2" rows="2"><?php if(empty($msg->success)){echo set_value('question_multiple');}?></textarea>
							<?=form_error('question_multiple');?>
                            <label>Укажите варианты ответа, галочкой пометьте верные</label>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="checkbox" name="chbox1" id="q1_ch1">
                                 </span>
                                <input name="answer1" type="text" id="q1_a1" class="form-control" value="<?php if(empty($msg->success)){echo set_value('answer1');}?>">
								<?=form_error('answer1');?>
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="checkbox" name="chbox2">
                                </span>
                                <input type="text" name="answer2" class="form-control" value="<?php if(empty($msg->success)){echo set_value('answer2');}?>">
								<?=form_error('answer2');?>
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="checkbox" name="chbox3">
                                 </span>
                                <input type="text" name="answer3" class="form-control" value="<?php if(empty($msg->success)){echo set_value('answer3');}?>">
								<?=form_error('answer3');?>
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="checkbox" name="chbox4">
                                 </span>
                                <input type="text" name="answer4" class="form-control" value="<?php if(empty($msg->success)){echo set_value('answer4');}?>">
								<?=form_error('answer4');?>
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="checkbox" name="chbox5">
                                 </span>
                                <input type="text" name="answer5" class="form-control" value="<?php if(empty($msg->success)){echo set_value('answer5');}?>">
								<?=form_error('answer5');?>
                            </div>
                            <span class="help-block">Заполните необходимое количество полей для ответов</span>
                        </div>

                        <div class="well-lg">
                            <label for="question_title4">Вопрос без вариантов ответа</label>
                                <textarea type="text" name="question_single" class="form-control" id="question_title4" rows="2"><?php if(empty($msg->success)){echo set_value('question_single');}?></textarea>
								<?=form_error('question_single');?>
                            <label>Укажите верный ответ</label>
                            <input type="text" name="answer_single" class="form-control" value="<?php if(empty($msg->success)){echo set_value('answer_single');}?>">
							<?=form_error('answer_single');?>
                        </div>
                        <input type="submit" name="add_question" class="btn btn-primary" value="Добавить вопросы" />
                    </div>
                </form>
            </div>
        </div>

<script>
$("form").submit(function () {

    var this_master = $(this);

    this_master.find('input[type="checkbox"]').each( function () {
        var checkbox_this = $(this);


        if( checkbox_this.is(":checked") == true ) {
            checkbox_this.attr('value','1');
        } else {
            checkbox_this.prop('checked',true);
            //DONT' ITS JUST CHECK THE CHECKBOX TO SUBMIT FORM DATA    
            checkbox_this.attr('value','0');
        }
    })
})
</script>