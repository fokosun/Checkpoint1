<?php

namespace Florence\Test;

use Florence\Data;
use Florence\Dictionary;
use Florence\Exceptions\WordExistsException;
use Florence\Exceptions\WordNotFoundException;

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

    /**
    *@expectedException Florence\Exceptions\WordNotFoundException
    */
    public function testWordNotFoundExceptionForDeleteSlang() {
        $this->dictionary->addSlangToDictionary('gala', 'snack', 'gala as food at the gala night');

        $this->assertTrue($this->dictionary->deleteSlangFromDictionary('galar'));
    }

    public function testDeleteSlangFromDictionary() {
        $this->dictionary->addSlangToDictionary('gala', 'snack', 'gala as food at the gala night');

        $this->assertTrue($this->dictionary->deleteSlangFromDictionary('gala'));
    }

    /**
    *@expectedException Florence\Exceptions\WordNotFoundException
    */
    public function testWordNotFoundExceptionForUpdateExistingSlang() {
        $this->dictionary->addSlangToDictionary('chop', 'to eat or pieces', 'get those chops and chop them off');

        $this->assertTrue($this->dictionary->updateExistingSlang('chopr', 'chinese cutlery', 'chop sticks for chop'));
    }

    public function testUpdateExistingSlang() {
        $this->dictionary->addSlangToDictionary('chop', 'to eat or pieces', 'get those chops and chop them off');
        $result = $this->dictionary->updateExistingSlang('chop', 'chinese cutlery', 'chop sticks for chop');

        $this->assertTrue($result);
        $this->assertNotEquals('to eat or pieces', $this->dictionary->getData()['chop']['description']);
        $this->assertEquals('chinese cutlery', $this->dictionary->getData()['chop']['description']);
    }

    public function testFindAndRetrieveSlang() {
        $this->dictionary->addSlangToDictionary('chop', 'to eat or pieces', 'get those chops and chop them off');
        $result = $this->dictionary->findAndRetrieveSlang('chop');

        $this->assertNotEmpty($result);
        $this->assertEquals('to eat or pieces', $result['description']);
    }

    public function testRankAndSort() {
        $sentence = 'Andrei: Prosper prosper prosper, are you done with the curriculum yet? Prosper: yes Andrei: Oh tight tight tight!';
        $ranker = ["prosper" => "4", "tight" => "3", "andrei" => "2", "yet" => "1", "oh" => "1", "curriculum" => "1", "yes" => "1", "with" => "1", "are" => "1", "you" => "1", "done" => "1", "the" => "1"];

        $this->assertEquals($ranker, $this->dictionary->rankAndSort($sentence));
    }

}
