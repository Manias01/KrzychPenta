<?php
class User extends AppModel
{
  var $name = 'User';

  var $validate = array (
    'username' => array (
      'rule' => 'notEmpty',
      'message' => 'Nazwa nie może być pusta'
    ),
    'password' => array (
      'rule' => 'notEmpty',
      'message' => 'Hasło nie może być puste'
    )
  );
}
?>