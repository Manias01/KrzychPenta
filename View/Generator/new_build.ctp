<h2>Wybierz postać do której chcesz napisać poradnik</h2>
<p>Filtr: <input type="text" id="new_build-filter" style="width:400px;height:20px;border-radius:5px" /></p>


<div id="list-champions">

<?foreach($champions as $champion):
    $img_url = $this->StrChanger->Dehumanize($champion['Champion']['name']);
    $champion['Champion']['image_src'] = $this->base.'/img/lol/champions/'.$img_url.'/'.$img_url.'.png';
?>
    <a href="<?=$this->Html->url(array('action'=>'save_new_build',$champion['Champion']['id']))?>" name="<?=strtolower($champion['Champion']['name'])?>">
        <?=$this->Thumb->Champion($champion['Champion']['name'])?>
        <p><?=$champion['Champion']['name']?></p>
    </a>
<?endforeach?>
    
</div>