<?php echo $scripts; ?>
<body>
	<?php echo $header; ?>

	<div class="container">
		<div class="row">
			<?php echo $sidebar; ?>
			<?php echo $content; ?>
		</div>
		<hr>
		<?php echo $footer; ?>
	</div>
	<script src="<?php echo base_url(); ?>js/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url(); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>js/script.js"></script>
</body>
</html>