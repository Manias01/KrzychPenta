<h2>Wybierz dwa Summoners Spells</h2>

<div id="sspells-box">

    <?foreach($ss as $s):?>
    <div class="sspell" id="<?=$s['Ss']['id']?>">
        <?=$this->Thumb->SS($s['Ss']['id'], $s['Ss']['name_en'])?><br/>
        <span class="mas-name"><?=$s['Ss']['name_en']?></span>
    </div><!--/sspell-->
    <?endforeach?>

</div><!--/sspells-box-->


<div id="chooseSS">

    <?=$this->Form->create()?>
        <?=$this->Form->input('ss1',array('type'=>'hidden','value'=>$build['Build']['ss1_id']))?>
        <?=$this->Form->input('ss2',array('type'=>'hidden','value'=>$build['Build']['ss2_id']))?>
        <?//=$this->Form->input('ss1_opis',array('type'=>'textarea'))?>
        <?//=$this->Form->input('ss2_opis',array('type'=>'textarea'))?>
    <p class="choose1">SS1 - X</p>
    <p class="choose2">SS2 - X</p>
    <?=$this->Form->end('Następny krok')?>

</div><!--chooseSS-->


<?//print_r($ss)?>
<!--
  <div class="sspell">
    <img src="wp-content/uploads/sspells/{$ss}" alt="{$ssName}" /><br />
    <span class="mas-name">{$ssName}</span>
  </div>
-->