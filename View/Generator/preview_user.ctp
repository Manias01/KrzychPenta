<div id="preview">
    <iframe src="<?=$this->Html->url(array('controller'=>'pages','action'=>'poradnik',$build_id))?>" style="width:1010px;height:800px;position:absolute;left:50%;margin-left:-497px;border:none"></iframe>
</div><!--/preview-->

<div id="preview-accept">
    <?=$this->Form->create()?>
        <?=$this->Form->input('build_id',array('type'=>'hidden','value'=>$build_id))?>
    <?=$this->Form->end('Wyślij poradnik do moderacji')?>
</div>