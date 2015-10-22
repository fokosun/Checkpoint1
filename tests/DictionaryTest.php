<?php

namespace Florence;


class DictionaryTest extends \PHPUnit_Framework_TestCase
{
    protected $dictionary;

    protected function setUp()
    {
        $this->dictionary = new Dictionary(Data::$data);
    }

    public function testAddSlangToDictionary() {

        $arr = [
            "slang" => "gala",
            "description" => 'snack',
            "sample-sentence" => "I bought gala for free today!"
        ];

        $this->assertEquals($arr, end($this->dictionary->addSlangToDictionary('gala',
            'snack',
            'I bought gala for free today!'
        )));

    }

    /**
     * @expectedException InvalidArgumentException
    */

    public function testDeleteSlangFromDictionary() {

      $this->assertArrayHasKey( 'gala', end($this->dictionary->deleteSlangFromDictionary('gala')) );

    }

    /**
     * @expectedException InvalidArgumentException
    */

    public function testUpdateExistingSlang() {

        $arr = [
            "slang" => "gala",
            "description" => 'nono',
            "sample-sentence" => "nano gala night lights for sale"
        ];

        $this->assertArrayHasKey($arr, end($this->dictionary->updateExistingSlang('gala', 'none', 'none')));

    }

    public function testFindAndRetrieveSlang() {

        $this->assertEquals('gala', $this->dictionary->findAndRetrieveSlang('gala'));

    }

    public function testRankAndSort() {

        $sentence = 'Andrei: Prosper prosper prosper, are you done with the curriculum yet? Prosper: yes Andrei: Oh tight tight tight!';

        $ranker = ["prosper" => "4", "tight" => "3", "andrei" => "2", "yet" => "1", "oh" => "1", "curriculum" => "1", "yes" => "1", "with" => "1", "are" => "1", "you" => "1", "done" => "1", "the" => "1"];

        $this->assertEquals($ranker, $this->dictionary->rankAndSort($sentence));

    }

}
