<?php

namespace Florence;

class DictionaryTest extends \PHPUnit_Framework_TestCase
{
    protected $dictionary;

    protected function setUp()
    {
        $this->dictionary = new Dictionary(Data::$data);
    }

    public function testAddSlangToDictionaryIsSuccessful() {

        $this->assertEquals(0, $this->dictionary->addSlangToDictionary('gala', 'snack', 'buy three gala for me'));

    }

    public function testAddSlangHasExactlyThreeArgs() {

        $this->assertEquals(3, $this->dictionary->getNumArgs());
    }

}
