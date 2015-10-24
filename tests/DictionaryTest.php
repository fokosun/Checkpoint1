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
        // fetches the temporary variable created in memory and stores in $fetched
        $fetched = $this->dictionary->addSlangToDictionary('gala','snack','I bought gala for free today!');

        $this->assertArrayHasKey('gala', $fetched);
    }

    public function testDeleteSlangFromDictionary() {
        $this->dictionary->addSlangToDictionary('gala', 'snack', 'gala as food at the gala night');

        $this->assertTrue($this->dictionary->deleteSlangFromDictionary('gala'));
        $this->assertNotContains('gala', $this->dictionary->getData());
    }

    public function testUpdateExistingSlang() {
        $this->dictionary->addSlangToDictionary('chop', 'to eat or pieces', 'get those chops and chop them off');
        $res = $this->dictionary->updateExistingSlang('chop', 'chinese cutlery', 'one too many chop sticks to chop');

        $this->assertTrue($res);
        $this->assertNotEquals('to eat or pieces', $this->dictionary->getData()['chop']['description']);
        $this->assertEquals('chinese cutlery', $this->dictionary->getData()['chop']['description']);
    }

    public function testFindAndRetrieveSlang() {
        $this->dictionary->addSlangToDictionary('chop', 'to eat or pieces', 'get those chops and chop them off');
        $res = $this->dictionary->findAndRetrieveSlang('chop');

        $this->assertNotEmpty($res);
        $this->assertEquals('to eat or pieces', $res['description']);
    }

    public function testRankAndSort() {
        $sentence = 'Andrei: Prosper prosper prosper, are you done with the curriculum yet? Prosper: yes Andrei: Oh tight tight tight!';
        $ranker = ["prosper" => "4", "tight" => "3", "andrei" => "2", "yet" => "1", "oh" => "1", "curriculum" => "1", "yes" => "1", "with" => "1", "are" => "1", "you" => "1", "done" => "1", "the" => "1"];

        $this->assertEquals($ranker, $this->dictionary->rankAndSort($sentence));
    }

}
