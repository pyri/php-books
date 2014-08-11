<div class="col-md-9">
	<h2>
        <?php echo $this->session->flashdata('firstPartMsg'); ?>
        <?php if($page != 'delete'):?>
        <a href="<?=base_url();?>lecture/read/<?=$this->session->flashdata('id')?>">
            <?php endif;?>
            <?=$this->session->flashdata('title')?>
            <?php if($page != 'delete'):?>
        </a>
    <?php endif;?>
        <?php echo $this->session->flashdata('secondPartMsg'); ?>
    </h2><br />
	<a href="<?=base_url(); ?>lecture/create" class="btn btn-primary">Создать еще лекцию</a>	
</div>
