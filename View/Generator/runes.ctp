<h2>Wybierz po 1 runie z każdego rodzaju</h2>


<ul class="runes-button">
  <li id="button-mark">Marks</li>
  <li id="button-seal">Seals</li>
  <li id="button-glyph">Glyphs</li>
  <li id="button-quint">Quintessences</li>
</ul>

<?for($type=1;$type<=4;$type++):?>

    <div id="rune-<?=$type?>" class="rune-type">
        <h3>Marks</h3>
       <?foreach($runes[$type] as $rune):?>
        <div class="rune<?=($build['Build']['runes'][$type]==$rune['Rune']['id'])?' highlight-rune':''?>"
             title="<?=$rune['Rune']['id']?>"
         >
         <?=$this->Thumb->Rune($rune['Rune']['name_en'])?>
          <span class="orange strong"><?=$rune['Rune']['name_en']?></span>
          <p class="mini"><?=$rune['Rune']['desc_en']?></p>
        </div> <!--/rune-->
       <?endforeach?>
    </div> <!--/rune-type-->

<?endfor?>

<div class="clear"></div>

<?=$this->Form->create()?>
    <?for($type=1;$type<=4;$type++):?>
        <?=$this->Form->input($type,array('type'=>'hidden','value'=>$build['Build']['runes'][$type]))?>
    <?endfor?>
<?=$this->Form->end('Następny krok')?>
    

<?//=print_r($build)?>