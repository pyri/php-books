<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
    <a href="<?=base_url();?>">Главная страница</a>

    <div class="panel panel-default">
        <div class="panel-footer">Лекции курса</div>
        <div class="panel-body">
            <ol>
                <?php foreach($list_lectures as $lecture):?>
                    <a href="<?=base_url().'lecturelectureUnAuth/read/'.$lecture->id;?>">
                        <li class="panel"><?=$lecture->title;?></li>
                    </a>
                <?php endforeach;?>
            </ol>
        </div>
    </div>
</div>