<?php

namespace Florence;

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

    /** test three
    * @dataProvider dataSource
    */

    public function testRemoveSlang($slang, $meaning, $sentence)
    {
        $stack = array($this->dictionary);

        array_push($stack, $slang, $meaning, $sentence);

        $this->assertEquals($slang, $meaning, $sentence, array_pop($this->stack));

        $this->assertTrue(empty($this->stack));
    }

    public function dataSource()
    {
        return array (

            array('wording', 'warning', 'you dont want wording')

        );
    }


}