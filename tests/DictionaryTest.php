<?php

namespace Florence;

use Florence\WordExistsException;
use Florence\WordNotFoundException;

class DictionaryTest extends \PHPUnit_Framework_TestCase
{
    protected $dictionary;

    protected function setUp() {
        $this->dictionary = new Dictionary;
    }

    public function testAddSlangToDictionary() {
        $expected = [
            "slang" => "gala",
            "description" => "snack",
            "sample-sentence" => "I bought gala for free today!"
        ];

        // fetches the temporary variable created in memory and stores in $fetched
        $fetched = $this->dictionary->addSlangToDictionary('gala','snack','I bought gala for free today!');

        // gets the last item in the returned array
        $actual = end($fetched);

        $this->assertEquals($expected, $actual);

    }

    /**
     *#expectedException WordNotFoundException
    */

    public function testDeleteSlangFromDictionary() {

        $this->dictionary->addSlangToDictionary('gala', 'snack', 'gala as food at the gala night');

        $slang = ['slang' => 'gala'];

        $this->assertEquals($slang, $this->dictionary->deleteSlangFromDictionary('gala'));

    }

    /**
     *
    */

    public function testUpdateExistingSlang() {

        $this->dictionary->addSlangToDictionary('chop', 'to eat or pieces', 'get those chops and chop them off');
        $arr = [
            "slang" => "chop",
            "description" => 'to eat or pieces',
            "sample-sentence" => "get those chops and chop them off"
        ];

        $this->assertEquals($arr, $this->dictionary->updateExistingSlang('chop', 'to eat or pieces', 'get those chops and chop them off'));
        // var_dump($arr);
        // var_dump($this->dictionary->updateExistingSlang('doughnut', 'snack', 'doughnut factory snack doughnut'));

    }


    public function testFindAndRetrieveSlang() {
        $this->dictionary->addSlangToDictionary('gala', 'snack', 'gala as food at the gala night');
        $arr = [
            "slang" => "gala",
            "description" => "snack",
            "sample-sentence" => "gala as food at the gala night"
        ];

        $this->assertEquals($arr, $this->dictionary->findAndRetrieveSlang('gala'));
    }


    public function testRankAndSort() {
        $sentence = 'Andrei: Prosper prosper prosper, are you done with the curriculum yet? Prosper: yes Andrei: Oh tight tight tight!';

        $ranker = ["prosper" => "4", "tight" => "3", "andrei" => "2", "yet" => "1", "oh" => "1", "curriculum" => "1", "yes" => "1", "with" => "1", "are" => "1", "you" => "1", "done" => "1", "the" => "1"];

        $this->assertEquals($ranker, $this->dictionary->rankAndSort($sentence));
    }

}
