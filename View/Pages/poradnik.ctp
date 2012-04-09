<div id="poradnik">

    <div id="shortcut">
        <h2><?=$build['Champion']['name']?></h2>

        <div id="introduction">
            <?=$build['Build']['introduction']?>
        </div>

        <div id="ss">
            <?=$this->Thumb->Ss($ss[0]['Ss']['id'], $ss[0]['Ss']['name_en'], 64)?>
            <?=$this->Thumb->Ss($ss[1]['Ss']['id'], $ss[1]['Ss']['name_en'], 64)?>
        </div><!--/ss-->

        
        <div id="runes">
            <?foreach($runes as $rune){
                echo $this->Thumb->Rune($rune['Rune']['id'], $rune['Rune']['name_en']);
            }?>
        </div><!--/runes-->


        <div id="items">
            <?foreach($items as $item){
                echo $this->Thumb->Item($item['Item']['id'], $item['Item']['name_en']);
            }?>
        </div>


        <table class="tabela-skill">

            <tr>
                <td class="skill">Umiejętność</td>
                <?for($num=1;$num<=18;$num++):?>
                    <td class="lv-name"><?=$num?></td>
                <?endfor?>
            </tr>

            <?for($type=1;$type<=4;$type++):?>
                <tr class="row-<?=$type?>">
                    <td class="skill">
                        <?=$this->Thumb->Skill($build['Champion']['name'],$skills[$type]['Skill']['id'],$skills[$type]['Skill']['name_en'])?>
                        <?=$skills[$type]['Skill']['name_en']?>
                    </td>

                    <?for($lv=1;$lv<=18;$lv++):?>
                    <?if(isSet($build['Build']['skill_sequence']['lv'.$lv]) && $build['Build']['skill_sequence']['lv'.$lv] == $type) $checked = true; else $checked = false;?>
                       <td class="sq"><?if($checked):?><img style="width:15px;height:15px;background:yellow;" /><?endif?></td>
                    <?endfor?>

                </tr>
            <?endfor?>

        </table><!--/tabela-skill-->


        <div id="masteries">
            <img src="<?=$this->base?>/img/lol/masteries/<?=$build['Build']['masteries']?>" alt="<?=str_replace('.jpg','',$build['Build']['masteries'])?>" />
        </div><!--/masteries-->


        <div id="opis">
            <?=$build['Build']['description']?>
        </div><!--/opis-->




    </div><!--/shortcut-->

</div><!--/poradnik-->


<?//print_r($build)?>