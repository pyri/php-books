<div class="col-md-9">
	<div class="jumbotron">
		<h2>Мои курсы</h2>
		<ul>
		<?php foreach ($courses as $course): ?>	
			<li><a href="<?=base_url();?>course/read/<?php echo $course->id; ?>"><?php echo $course->title; ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>

	<div class="jumbotron">
		<h2>Мои тесты</h2>
		<ul>
		<?php foreach ($tests as $test): ?>	
			<li><a href="<?=base_url();?>test/read/<?php echo $test->id; ?>"><?php echo $test->title; ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
</div>