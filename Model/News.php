<?php
class News extends AppModel
{
  var $name = 'News';

  var $validate = array (
    'title' => array (
      'rule' => 'notEmpty',
      'message' => 'Tytuł nie może być pusty'
    )
  );
}
?>