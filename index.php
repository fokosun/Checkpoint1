<?php

require_once "vendor/autoload.php";

use Florence\Dictionary;
use Florence\Data;

$dictionary = new Dictionary;

$dictionary->addSlangToDictionary('Oshey', 'Yoruba term for showing appreciation', 'Your tests rae passing Oshey!');

var_dump($dictionary->getData()) ;

// foreach($this->data as $key) {

//     var_dump($key);

// }