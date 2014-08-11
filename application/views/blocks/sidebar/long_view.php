<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
    <a href="<?=base_url();?>">Главная страница</a>
   <div class="list-group">
	
		<?php $uri_string = array('office');?>			
		<a href="<?=base_url();?>office" class="list-group-item <?=active($uri_string);?>">Личный кабинет</a>								
		
		<?php 				
		$uri_string = array(
			'course/create',
			'course/index',
			'lecture/create',
			'lecture/index');
		?>				
		<a href="<?=base_url();?>course/create" class="list-group-item <?=active($uri_string);?>">Создать курс</a>
		
		<?php $uri_string = array(
			'test/create',
			'test/index',
			'question/create',
			'question/index');?>
		<a href="<?=base_url();?>test/create" class="list-group-item <?=active($uri_string);?>" >Создать тест</a>

       <a href="<?=base_url();?>pages/logout" class="list-group-item">Выйти</a>
	</div>
    <div class="panel panel-default">
        <div class="panel-footer">Лекции курса</div>
        <div class="panel-body">
            <ol>
                <?php foreach($list_lectures as $lecture):?>
                <a href="<?=base_url().'lecture/read/'.$lecture->id;?>">
                    <li class="panel"><?=$lecture->title;?></li>
                </a>
                <?php endforeach;?>
            </ol>
        </div>
    </div>
</div>