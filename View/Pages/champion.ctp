<div id="poradnik">

    <div id="shortcut" style="background: url('<?=$this->base?>/img/lol/backgrounds/<?=$this->Thumb->Dehumanize($champion['Champion']['name'])?>_background.jpg') 0 0 no-repeat;">
        <h2><?=$champion['Champion']['name']?></h2>

        <div id="champion-price">
            <h3>Cena:</h3>
            <div>
                <img src="<?=$this->base?>/img/frontend/ip.png" alt=""/><h3><?=$champion['Champion']['ip']?></h3>
            </div>
            <div>
                <br/>lub
            </div>
            <div>
                <img src="<?=$this->base?>/img/frontend/rp.png" alt=""/><h3><?=$champion['Champion']['rp']?></h3>
            </div>
        </div><!--/champion-price-->

        <div id="champion-skills">
            <h3>Umiejętności</h3>
            <?
            echo $this->Thumb->Skill($champion['Champion']['name'],$champion['Skill'][4]['id'],$champion['Skill'][4]['name_en'],64);

            for($a=0;$a<=3;$a++):
                echo $this->Thumb->Skill($champion['Champion']['name'],$champion['Skill'][$a]['id'],$champion['Skill'][$a]['name_en'],64);
            endfor;?>
        </div><!--/champion-skills-->

    </div><!--/shortcut-->
</div><!--/poradnik-->



<div id="another-builds">
    <h4>Zobacz także</h4>
    <?foreach($another_champions as $another):
        $new_link = array('controller'=>'pages','action'=>'champion',strtolower($another['Champion']['name']));
    ?>
        <a href="<?=$this->Html->url($new_link)?>" class="another-champ">

            <?=$this->Thumb->champion($another['Champion']['id'],$another['Champion']['name'],64,'builds-thumb')?>

            <div class="another-champ-title">
                <h3><?=$another['Champion']['name']?></h3>
            </div><!--/another-champ-->

            
            <div class="clear"></div>
        </a><!--/another-champ-->
    <?endforeach?>

</div><!--/another-builds-->