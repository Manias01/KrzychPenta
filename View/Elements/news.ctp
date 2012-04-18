<div id="newsy">
    <?foreach($news as $new):
        $new = $new['News'];

        if($new['type']=='poradnik'){//image for news
            $champ_name = $this->Thumb->Dehumanize($new['title']);
            $img_url = 'lol/champions/'.$champ_name.'/'.$champ_name.'_64.png';
            $news_link = array('controller'=>'pages','action'=>'poradnik',$champ_name);
        }else{
            $img_url = 'news/'.$new['image'];
            $news_link = array('controller'=>'news','action'=>'single_news',$new['id']);
        }
    ?>

    <div class="news">
        <h2><?=$this->Html->link($new['type'],$news_link)?></h2>

        <?
        echo $this->Html->link(//image for news
                $this->Html->image($img_url,array('alt'=>$new['title'])),
                $news_link,
                array('class'=>'news-img','escape'=>false)
            );
        ?>
        
        <div class="news-title">
            <h3><?=$this->Html->link($new['title'],$news_link)?></h3>
        </div><!--/news-title-->

        <div class="news-text">
                <?=$this->Text->truncate($new['text'],200)?><br/>
                <?=$this->Html->link('... czytaj dalej »',$news_link)?>
        </div>
        <div class="clear"></div>
    </div><!--/news-->

    <?endforeach?>

    
    <div id="pagination">
        <?=$this->Paginator->prev('« Nowsze', null, null, array('style'=>'display:none')); ?>
        <?=$this->Paginator->numbers(array('separator'=>' / '))?>
        <?=$this->Paginator->next('Starsze »', null, null, array('style'=>'display:none')); ?>
    </div><!--/pagination-->
    
</div><!--/newsy-->

