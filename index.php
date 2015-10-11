<?php

namespace Florence;

require_once "vendor/autoload.php";

//Task One:

echo "<h4>Task 1 - Create Data Array:</h4>";

foreach(Data::$data as $row => $innerArray)
{
    foreach ( $innerArray as $innerRow => $value )
    {
        echo $value . PHP_EOL . "<br>";
    }
}


//Task Two:

echo "<h4>Task 2 - Implement CRUD:</h4>".PHP_EOL;
echo "To Add Slang: . ```code```. "."<br>";
echo "To Retrieve Slang:" . "<br>";
echo "To Update Slang:" . "<br>";
echo "To Delete Meaning of Slang: " . "<br>";





echo "<h4>Task 3 - Implement Ranking System:</h4>".PHP_EOL;




// var_dump(Data::$data[0]);

$dictionary = new Dictionary();



$dictionary->addSlang('Mheen', 'Casual expression', 'Mheen, i just dey oh!');


print_r($dictionary->getData());


