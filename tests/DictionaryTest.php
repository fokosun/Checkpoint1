<?php

namespace Florence;

use Florence\Data;
use Florence\Dictionary;

class DictionaryTest extends \PHPUnit_Framework_TestCase
{
    protected $dictionary;

    protected function setUp()
    {
        $this->dictionary = new Dictionary(Data::$data);
    }

    /* test one
    ** This one tests if my associative array is empty
    */
    public function testNotEmpty()
    {
        $this->assertNotEmpty(($this->dictionary));
    }


    /** test two
    * @dataProvider dataSource
    * This one tests push operation
    */

    public function testAddSlang($slang, $meaning, $sentence)
    {
        $stack = array($this->dictionary);

        array_push($stack, array($slang, $meaning, $sentence));

        $this->assertEquals(array($slang, $meaning, $sentence), $stack[count($stack)-1]);

        $this->assertNotEmpty($stack);

    }

    public function dataSource()
    {
        return array (

            array('wording', 'warning', 'you dont want wording')

        );
    }


}