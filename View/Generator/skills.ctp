<h2>Sprawdź czy opisy skilli są poprawne</h2>

<h2><?=$this->Session->flash();?></h2>

<div class="build">
    <?=$this->Thumb->Champion($champion['Champion']['name'])?>
    <p><?=$champion['Champion']['name']?></p>
</div><!--/build-->

<div class="clear"></div>

<?=$this->Form->create('Skill');?>
    <?$a=0;foreach($skills as $skill):?>
    <div class="skill">


        <fieldset>
            <legend><? echo $skill['Skill']['name_en']; ?></legend>
    <?
            echo $this->Thumb->Skill($champion['Champion']['name'],$skill['Skill']['name_en']);
            echo $this->Form->input($a.'.Skill.id',array('value'=>$skill['Skill']['id']));
            echo $this->Form->input($a.'.Skill.name_en',array('value'=>$skill['Skill']['name_en']));
            echo $this->Form->input($a.'.Skill.name_pl',array('value'=>$skill['Skill']['name_pl']));
            echo '<div class="skill-desc">';
            echo '<p>'.$skill['Skill']['desc_pl'].'</p>';
            echo $this->Form->input($a.'.Skill.desc_pl',array('value'=>$skill['Skill']['desc_pl']));
            echo '</div><!--/skill-desc-->';
            echo $this->Form->input($a.'.Skill.cooldown',array('value'=>$skill['Skill']['cooldown']));
            echo $this->Form->input($a.'.Skill.cost',array('value'=>$skill['Skill']['cost']));
            echo $this->Form->input($a.'.Skill.range',array('value'=>$skill['Skill']['range']));
    ?>
        </fieldset>

    </div>

    <?$a++;endforeach?>
    <a href="" class="next">Następny krok</a>
<?=$this->Form->end('Zaktualizuj dane');?>