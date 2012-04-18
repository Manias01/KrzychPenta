<br/>
<?if(isSet($empty)):?>
    <?if($empty=='empty'){ echo '<h3>Wpisz fraze do wyszukania</h3>';}?>
    <?if($empty=='short'){ echo '<h3>Wpisz więcej znaków do wyszukiwarki</h3>';}?>
    <?if($empty=='long'){ echo '<h3>Wpisz mniej znaków do wyszukiwarki</h3>';}?>
    
<?else:?>
    <h5>Znalezione strony dla słów: "<?foreach($phrases as $phrase){echo $phrase.' ';}?>"</h5>

    <h2>Poradniki</h2>
    <?=$this->element('builds',array('builds'=>$results['builds']));?>

    <h2>Championi</h2>
    <?=$this->element('champions',array('champions'=>$results['champions']));?>

<?endif?>


