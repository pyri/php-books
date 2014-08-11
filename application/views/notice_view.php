<div class="col-md-9">
	<h2>
        <?php echo $this->session->flashdata('firstPartMsg'); ?>
        <?php if($page != 'delete'):?>
        <a href="<?=base_url();?><?=$this->session->flashdata('object');?>/read/<?=$this->session->flashdata('id')?>">
        <?php endif;?>
            <?=$this->session->flashdata('title')?>
        <?php if($page != 'delete'):?>
        </a>
        <?php endif;?>
        <?php echo $this->session->flashdata('secondPartMsg'); ?>
    </h2><br />
    <?php if($page == 'create' and $this->session->flashdata('object') == 'course'):?>
	    <a href="<?=base_url(); ?>lecture/create" class="btn btn-primary">Создать лекцию</a>
    <?php endif;?>
    <?php if($page == 'create' and $this->session->flashdata('object') == 'test'):?>
        <a href="<?=base_url(); ?>question/create" class="btn btn-primary">Добавить вопросы</a>
    <?php endif;?>
</div>


