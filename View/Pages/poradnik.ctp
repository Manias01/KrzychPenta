<div id="poradnik">

    <div id="shortcut" style="background: url('<?=$this->base?>/img/lol/backgrounds/<?=$this->Thumb->Dehumanize($build['Champion']['name'])?>_background.jpg') 0 0 no-repeat;">
        <h2><?=$build['Champion']['name']?></h2>

        <div id="introduction">
            <?=$build['Build']['introduction']?>
        </div>

        <div id="ss-runes-panel">
            <div id="ss">
                <div>
                    <?=$this->Thumb->Ss($ss[0]['Ss']['id'], $ss[0]['Ss']['name_en'], 55)?>
                    <?=$ss[0]['Ss']['name_en']?>
                </div>
                <div>
                    <?=$this->Thumb->Ss($ss[1]['Ss']['id'], $ss[1]['Ss']['name_en'], 55)?>
                    <?=$ss[1]['Ss']['name_en']?>
                </div>
            </div><!--/ss-->


            <div id="runes">
                <?foreach($runes as $rune){
                    echo '<div>';
                    echo $this->Thumb->Rune($rune['Rune']['id'], $rune['Rune']['name_en']);
                    echo $rune['Rune']['name_en'];
                    echo '</div>';
                }?>
            </div><!--/runes-->
        </div><!--/ss-runes-panel-->


        <div id="items">
            <?foreach($items as $key=>$item){
                echo '<div>';
                echo $this->Thumb->Item($item['Item']['id'], $item['Item']['name_en'],64);
                echo '</div>';
            }?>
        </div><!--/items-->

    </div><!--/shortcut-->


    <table id="skill_sequence">
        <h4>Kolejność skilli</h4>
        <tr>
            <th class="skill">Umiejętność</th>
            <?for($num=1;$num<=18;$num++):?>
                <td class="lv-name"><?=$num?></td>
            <?endfor?>
        </tr>

        <?for($type=0;$type<=3;$type++):?>
            <tr class="row-<?=$type?>">
                <th class="skill">
                    <?=$this->Thumb->Skill($build['Champion']['name'],$skills[$type]['Skill']['id'],$skills[$type]['Skill']['name_en'],20)?>
                    <?=$skills[$type]['Skill']['name_en']?>
                </th>

                <?for($lv=1;$lv<=18;$lv++):?>
                <?if(isSet($build['Build']['skill_sequence']['lv'.$lv]) && $build['Build']['skill_sequence']['lv'.$lv] == $type) $checked = true; else $checked = false;?>
                   <td class="sq"><?if($checked):?><img src="<?=$this->base?>/img/frontend/skill_add.png" class="skill" tip_id="<?=$skills[$type]['Skill']['id']?>" alt="" /><?endif?></td>
                <?endfor?>

            </tr>
        <?endfor?>

    </table><!--/skill_sequence-->


    <div id="masteries">
        <h4>Specjalizacja</h4>
        <img src="<?=$this->base?>/img/lol/masteries/<?=$build['Build']['masteries']?>" alt="<?=str_replace('.jpg','',$build['Build']['masteries'])?>" />
    </div><!--/masteries-->

    
    <?/*advert*/?>
<?if($this->base != '/KrzychPenta')://if it's NOT localhost:?>
    <div class="dodatek-horizontal">
        <cake:nocache>
            <?=(isSet($ads['horizontal']['Ad']['code']))?$ads['horizontal']['Ad']['code']:''?>
        </cake:nocache>
    </div><!--/dodatek-horizontal-->
<?endif//if it's NOT localhost:?>
    <?/*end advert*/?>


    <div id="description">
        <h4 class="title">Sposób gry</h4>
        <p><?=$build['Build']['description']?></p>
    </div><!--/opis-->

</div><!--/poradnik-->


<?if(!empty($another_builds)):?>

    <div id="another-builds">
        <h4>Zobacz także</h4>
        <?foreach($another_builds as $another):
            $new_link = array('controller'=>'pages','action'=>'poradnik',strtolower($another['Champion']['name']));
        ?>
            <div class="news">
                <h2><?=$this->Html->link($another['Build']['name'],$new_link)?></h2>

                <?=$this->Html->link(
                        $this->Thumb->champion($another['Champion']['id'],$another['Champion']['name'],64,'builds-thumb'),
                        $new_link,array('escape'=>false)
                );?>

                <div class="news-title">
                    <h3><?=$this->Html->link($another['Champion']['name'],$new_link)?></h3>
                </div><!--/news-title-->

                <div class="news-text">
                        <?=$this->Text->truncate($another['Build']['introduction'],200)?><br/>
                        <?=$this->Html->link('... czytaj dalej »',$new_link)?>
                </div>
                <div class="clear"></div>
            </div><!--/news-->
        <?endforeach?>

    </div><!--/another-builds-->

<?endif?>

