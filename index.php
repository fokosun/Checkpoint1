<?php

require_once "vendor/autoload.php";

use Florence\Dictionary;
use Florence\Data;

$dictionary = new Dictionary;

$dictionary->addSlangToDictionary('gala', 'snack', 'I bought gala for free today!');

$dictionary->updateExistingSlang('gala', 'nano', 'nano gala night lights for sale');

var_dump($dictionary->findAndRetrieveSlang('gala')) ;

echo"<br>";
$arr = [
            "slang" => "gala",
            "description" => 'nono',
            "sample-sentence" => "nano gala night lights for sale"
        ];
var_dump($arr);

echo"<br>";echo"<br>";echo"<br>";echo"<br>";
var_dump($dictionary->rankAndSort('Andrei: Prosper prosper prosper, are you done with the curriculum yet? Prosper: yes Andrei: Oh tight tight tight!'));
echo"<br>";
echo"<br>";echo"<br>";echo"<br>";echo"<br>";
var_dump($dictionary->getData()) ;

// foreach($this->data as $key) {

//     var_dump($key);

// }