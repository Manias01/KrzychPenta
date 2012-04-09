<div id="newsy">
    <?foreach($builds as $new):
        $new_link = array('controller'=>'pages','action'=>'poradnik',strtolower($new['Champion']['name']));
    ?>

    <div class="news">
        <h2><?=$this->Html->link($new['Build']['name'],$new_link)?></h2>

        <?=$this->Html->link(
                $this->Thumb->champion($new['Champion']['id'],$new['Champion']['name'],64,'builds-thumb'),
                $new_link,array('escape'=>false)
        );?>

        <div class="news-title">
            <h3><?=$this->Html->link($new['Champion']['name'],$new_link)?></h3>
        </div><!--/news-title-->

        <div class="news-text">
                <?=$this->Text->truncate($new['Build']['introduction'],200)?><br/>
                <?=$this->Html->link('... czytaj dalej »',$new_link)?>
        </div>
        <div class="clear"></div>
    </div><!--/news-->

    <?endforeach?>


    <div id="pagination">
        <?=$this->Paginator->prev('« Poprzednie', null, null, array('style'=>'display:none')); ?>
        <?=$this->Paginator->numbers(array('separator'=>' / '))?>
        <?=$this->Paginator->next('Następne »', null, null, array('style'=>'display:none')); ?>
    </div><!--/pagination-->

</div><!--/newsy-->

