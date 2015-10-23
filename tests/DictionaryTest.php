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

        $actual = (end($this->dictionary->addSlangToDictionary('gala','snack','I bought gala for free today!')));

        $this->assertEquals($expected, $actual);

        // var_dump($this->dictionary->addSlangToDictionary('gala','snack','I bought gala for free today!'));
    }

    /**
     *
    */

    public function testDeleteSlangFromDictionary() {

        $this->dictionary->addSlangToDictionary('gala', 'snack', 'gala as food at the gala night');

        $this->assertEquals(true, $this->dictionary->deleteSlangFromDictionary('gala'));

    }

    /**
     *
    */

    public function testUpdateExistingSlang() {
        $this->dictionary->addSlangToDictionary('gala', 'snack', 'gala as food at the gala night');
        $arr = [
            "slang" => "gala",
            "description" => 'nano',
            "sample-sentence" => "nano gala night lights for sale"
        ];

        $this->assertEquals($arr, $this->dictionary->updateExistingSlang('gala', 'nano', 'nano gala night lights for sale'));
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
