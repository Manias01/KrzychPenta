<pre>
<?//print_r($news)?>
</pre>

<?foreach($news as $new):
    $new = $new['News'];
    $news_link = array('controller'=>'news','action'=>'single_news',$new['id']);
?>

<div class="news">
    <?=$this->Html->link(
            $this->Html->image('news/'.$new['image'],array('alt'=>$new['title'])),
            $news_link,
            array('class'=>'news-img','escape'=>false)
        );
    ?>
    <h2><?=$this->Html->link($new['title'],$news_link)?></h2>
    <span class="news-text">
            <?=$this->Text->truncate($new['text'],200)?>
            <?=$this->Html->link('czytaj dalej »',$news_link)?>
    </span>
</div><!--/news-->

<?endforeach?>