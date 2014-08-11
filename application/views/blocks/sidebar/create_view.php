<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
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
		
		<form  method="post">
			<input type="submit" class="btn btn-primary" name="logout" value="Выйти" />
		</form>
	</div>
</div>