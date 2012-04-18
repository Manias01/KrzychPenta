<div id="another-builds">
    <?foreach($champions as $another):
        $new_link = array('controller'=>'pages','action'=>'champion',$this->Thumb->Dehumanize($another['Champion']['name']));
    ?>
        <a href="<?=$this->Html->url($new_link)?>" class="another-champ">

            <?=$this->Thumb->champion($another['Champion']['id'],$another['Champion']['name'],64,'builds-thumb')?>

            <div class="another-champ-title">
                <h3><?=$another['Champion']['name']?></h3>
            </div><!--/another-champ-->

            <div id="champions-price">
                <div>
                    <img src="<?=$this->base?>/img/frontend/ip.png" alt=""/><h3><?=$another['Champion']['ip']?></h3>
                </div>
                <div>
                    <br/>lub
                </div>
                <div>
                    <img src="<?=$this->base?>/img/frontend/rp.png" alt=""/><h3><?=$another['Champion']['rp']?></h3>
                </div>
            </div><!--/champions-price-->


            <div class="clear"></div>
        </a><!--/another-champ-->
    <?endforeach?>

    <div id="pagination">
        <?=$this->Paginator->prev('« Poprzednie', null, null, array('style'=>'display:none')); ?>
        <?=$this->Paginator->numbers(array('separator'=>' / '))?>
        <?=$this->Paginator->next('Następne »', null, null, array('style'=>'display:none')); ?>
    </div><!--/pagination-->

</div><!--/another-builds-->