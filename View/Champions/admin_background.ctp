<?if(!isSet($this->params['pass'][1]))://first step:?>

    <h2>Dodaj obraz tła (krok 1/2)</h2>

    <?=$this->Form->create('Champion',array('type' => 'file'))?>
        <?=$this->Form->file('background')?>
    <?=$this->Form->end('Zapisz')?>


<?else: //second step:?>

    <h2>Wytnij interesującą część (krok 2/2)</h2>


    <script type="text/javascript">
        $(document).ready(function () {
            $('img#crop').imgAreaSelect({
                aspectRatio: '600:250',
                onSelectEnd: function (img, selection) {
                    $('input#ChampionX1').val(selection.x1);
                    $('input#ChampionY1').val(selection.y1);
                    $('input#ChampionX2').val(selection.x2);
                    $('input#ChampionY2').val(selection.y2);
                    $('input#ChampionWidth').val(selection.width);
                    $('input#ChampionHeight').val(selection.height);
                }
            });
        });
    </script>

    <img id="crop" src="<?=$this->base?>/img/upload_temp/<?=$this->params['pass'][1]?>.jpg" alt="" style="border: 1px solid red;" />

    <?=$this->Form->create('Champion',array('type' => 'file'))?>
        <?=$this->Form->input('x1',array('type'=>'hidden'))?>
        <?=$this->Form->input('y1',array('type'=>'hidden'))?>
        <?=$this->Form->input('x2',array('type'=>'hidden'))?>
        <?=$this->Form->input('y2',array('type'=>'hidden'))?>
        <?=$this->Form->input('width',array('type'=>'hidden'))?>
        <?=$this->Form->input('height',array('type'=>'hidden'))?>
    <?=$this->Form->end('Zapisz')?>

    
<?endif?>