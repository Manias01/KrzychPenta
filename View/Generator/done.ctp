<div id="done">
    <h1>Poradnik został zapisany i opublikowany</h1>
    <br/>
    <h3>Co chcesz teraz zrobić?</h3>

    <br/><br/>

    <a href="<?=$this->base?>/admin">Wrócić do panelu admina</a>
    <a href="<?=$this->Html->url(array('controller'=>'pages','action'=>'poradnik',$this->params['pass'][0]))?>">Przejść na stronę poradnika</a>
</div><!--/done-->