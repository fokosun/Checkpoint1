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
     * @expectedException WordNotFoundException
    */

    public function testDeleteSlangFromDictionary() {

      $this->assertArrayHasKey( 'gala', end($this->dictionary->deleteSlangFromDictionary('tight')) );

    }


    public function testFindAndRetrieveSlang() {



    }

    public function testRankAndSort() {

    }



}
