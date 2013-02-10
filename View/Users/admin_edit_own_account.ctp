<div class="users form">
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend>Edycja konta</legend>
    <?php
        echo $this->Form->input('id');
        echo $this->Form->input('username');
        echo $this->Form->input('password',array('label'=>'Nowe hasło:'));
    ?>
    </fieldset>
<?php echo $this->Form->end('Zmień');?>
</div>