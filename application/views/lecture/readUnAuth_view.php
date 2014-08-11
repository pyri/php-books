<div class="col-md-9">
	<div class="lecture">				
		<h1 class="text-center"><?php echo $lecture->title;?></h1><br />
		<p><?php echo $lecture->content;?></p>

        <?php if(!empty($lecture->selfquestions)):?>
            <h3>Вопросы для самопроверки</h3>
            <p><?php echo $lecture->selfquestions;?></p>
        <?php endif;?>

        <?php if(!empty($lecture->example)):?>
            <h3>Примеры</h3>
            <p><?php echo $lecture->example;?></p>
        <?php endif;?>

        <?php if(!empty($lecture->task)):?>
            <h3>Задачи</h3>
            <p><?php echo $lecture->task;?></p>
        <?php endif;?>

        <?php if(!empty($test->title)):?>
            <h3><a href="<?=base_url();?>testUnAuth/read/<?=$test->test_id;?>">Тест "<?php echo $test->title;?>"</a></h3>
        <?php endif;?>


        <?php /*
        $questionsForLecture = '';
        foreach ($questions as $key => $question) {
            $questionsForLecture = $questionsForLecture.'<h4>'.$question['title'].'</h4>';
            foreach ($question['answers'] as $answer) {
                $questionsForLecture = $questionsForLecture.'<p>'.$answer['option'].'</p>';
            }
        }
        echo '<h4>'.$questionsForLecture.'</h4>';*/
       ?>
	</div>
</div>
