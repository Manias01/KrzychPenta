<h2><?=$this->Session->flash();?></h2>

<h2>Nazwij poradnik:</h2>
<div id="skills-header-background">
    <div class="build">
        <?=$this->Thumb->Champion($build['Champion']['id'],$build['Champion']['name'])?>
        <p><?=$build['Champion']['name']?></p>
    </div><!--/build-->


    <?=$this->Form->create('Build',array('url'=>array('controller'=>'generator','action'=>'save_buildName_skills')))?>
        <?=$this->Form->input('id',array('value'=>$build['Build']['id']))?>
        <?=$this->Form->input('name',array('label'=>$build['Champion']['name'].' - ','value'=>$build['Build']['name']))?>
    <?=$this->Form->end("Zapisz nazwę a potem sprawdź skille")?>

    
    <div class="clear"></div>
    
</div><!--/skills-header-background-->





<h2>A następnie sprawdź czy opisy skilli są poprawne:</h2>



<?=$this->Form->create('Skill');?>
    <?$a=0;foreach($skills as $skill):?>
    <div class="skill">


        <fieldset>
            <legend><? echo $skill['Skill']['name_en']; ?></legend>
    <?
            echo $this->Thumb->Skill($build['Champion']['id'],$build['Champion']['name'],$skill['Skill']['name_en']);
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
    <a href="<?=$this->Html->url(array('action'=>'skill_sequence',$build['Build']['id']))?>" class="next">Następny krok</a>
<?=$this->Form->end('Zaktualizuj dane');?>