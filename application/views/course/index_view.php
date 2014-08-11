<div class="col-md-9">
	<h2><?php echo $this->session->flashdata('msg'); ?></h2><br />
    <?php if($page == 'create'):?>
	    <a href="<?=base_url(); ?>lecture/create" class="btn btn-primary">Создать лекцию</a>
    <?php endif;?>
</div>


