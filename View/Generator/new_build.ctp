<h2>Wybierz postać do której chcesz napisać poradnik</h2>
<p>Filtr: <input type="text" id="new_build-filter" style="width:400px;height:20px;border-radius:5px" /></p>


<div id="list-champions">
    <div id="filter-champions">

<?foreach($champions as $champion):?>
        <a href="<?=$this->Html->url(array('action'=>'save_new_build',$champion['Champion']['id']))?>" name="<?=strtolower($champion['Champion']['name'])?>">
            <?=$this->Thumb->Champion($champion['Champion']['id'],$champion['Champion']['name'],64)?>
            <p><?=$champion['Champion']['name']?></p>
        </a>
<?endforeach?>
        
    </div><!--/filter-champions-->
</div><!--/list-champions-->