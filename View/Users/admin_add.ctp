<br/><br/>
<?=$this->Session->flash();?>

<?=$this->Form->create('User',array('action'=>'add','type'=>'post'))?>

<?=$this->Form->input('username',array('label'=>'Nazwa'))?>
<?=$this->Form->input('password',array('label'=>'Hasło','value'=>false))?>
<?=$this->Form->input('type',array('label'=>'Dostęp','type'=>'select','options'=>Configure::read('select_users_type'),'default'=>'1'))?>



<?=$this->Form->end('Dodaj')?>