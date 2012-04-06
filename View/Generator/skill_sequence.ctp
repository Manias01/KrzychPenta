<h2>Kolejność wyboru umiejętności</h2>

<div class="build">
    <?=$this->Thumb->Champion($build['Champion']['id'],$build['Champion']['name'])?>
    <p><?=$build['Champion']['name']?></p>
</div><!--/build-->

<div class="clear"></div>

<?=$this->Form->create()?>
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
                <?=$this->Thumb->Skill($build['Champion']['id'],$build['Champion']['name'],$skills[$type]['Skill']['name_en'])?>
                <?=$skills[$type]['Skill']['name_en']?>
            </td>

            <?for($lv=1;$lv<=18;$lv++):?>
            <?if(isSet($build['Build']['skill_sequence']['lv'.$lv]) && $build['Build']['skill_sequence']['lv'.$lv] == $type) $checked = true; else $checked = false;?>
               <td class="sq"><input type="radio" name="lv<?=$lv?>" value="<?=$type?>" <?=($checked)?'checked="checked"':''?> /></td>
            <?endfor?>

        </tr>

    <?endfor?>

    </table><!--/tabela-skill-->
    
<?=$this->Form->end('Następny krok')?>