<?php

namespace Florence;

require_once "vendor/autoload.php";

//Task One:

echo "<h1>Task 1 - Create Data Array (Class name: Data.php): </h1>";

foreach(Data::$data as $row => $innerArray)
{
    foreach ( $innerArray as $innerRow => $value )
    {
        echo $innerRow. ": ";
        echo $value . "<br><br>";
    }
}


//Task Two:

echo "<h1>Task 2 - Implement CRUD:</h1>".PHP_EOL;

echo "<h4>To Add Slang:</h4> - implement using addSlang('$'slang, '$'description, '$'sentence); <p> e.g. '$'newSlang->addSlang('Yimu', 'Way of showing disapproval or envy', 'Yimu at you, your code is not passing.');</p>";

echo "<h4>To Retrieve Slang:</h4> - implement using findSlang('$'slang); <p> e.g. '$'newSlang->addSlang('Yimu');</p>";

echo "<h4>To Update Slang:</h4> - implement using updateSlang('$'slang, '$'description, '$'sentence); <p> e.g. '$'newSlang->updateSlang('Yimmu', 'Way of showing disapproval or envy', 'Yimmu at you, your code is not passing.');</p>";

echo "<h4>To Delete Slang:</h4> - implement using removeSlang('$'slang); <p> e.g. '$'newSlang->removeSlang('Yimu');</p>";

echo "<h1>Task 3 - Implement Ranking System:</h1>".PHP_EOL;

// var_dump(Data::$data[0]);

$dictionary = Data::$data;
        $ranker = new Dictionary($dictionary);
        $getRank = $ranker->rankWords('Prosper, Have you finished the curriculum? Yes, Tight, Tight, Tight!');
        print_r($getRank);

// $dictionary->addSlang('Mheen', 'Casual expression', 'Mheen, i just dey oh!');


// print_r($dictionary->getData());


