<div class="col-md-9">
    <a href="<?=base_url()?>">Главная страница</a>
    <div class="lecture">
        <h1 class="text-center text-primary"><?php echo $course['0']['c_title'];?></h1><br />
        <h4>Автор(-ы) курса: <?php echo $course['0']['c_author'];?></h4>
        <h4>Тип учебного издания: <?php echo $course['0']['c_type'];?></h4>
        <h3>Содержание курса</h3>
        <ul>
            <?php foreach ($course as $lecture): ?>
                <li>
                    <a href="<?=base_url();?>lectureUnAuth/read/<?php echo $lecture['l_id']; ?>">
                        <?php
                        echo $lecture['l_title'];
                        $listLectures = '';
                        $listLectures = $listLectures.$lecture['l_title'];
                        ?>
                    </a>
                </li>
            <?php endforeach;?>
        </ul>


        <?php if(!empty($course['0']['c_source'])):?>
            <h3>Список используемой литературы</h3>
            <?php echo $course['0']['c_source']; ?>
        <?php endif;?>

        <?php if(!empty($questions)):?>
            <h3><a href="<?=base_url()?>testUnAuth/read/<?=$test[0]['test_id']?>">Тест "<?php echo $test[0]['title']; ?>"</a></h3>
        <?php endif;?>
    </div>
</div>