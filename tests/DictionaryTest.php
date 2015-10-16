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

        // return $stack;

    }

    /** test three
    * tests for findSlang
    */

    public function testFindSlang()
    {

        $this->dictionary->addSlang('bar', 'Term for money', 'Hold your bar');

        $wordMatch = $this->dictionary->findSlang('bar');

        $this->assertEquals('bar', $wordMatch['slang']);

        $this->assertEquals('Term for money', $wordMatch['description']);

        $this->assertEquals('Hold your bar', $wordMatch['sample-sentence']);

    }

    /** test four
    * tests for updateSlang
    */

    public function testUpdateSlang()
    {

        $this->dictionary->addSlang('bar', 'Term for money', 'Hold your bar');

        $this->dictionary->updateSlang('bar', 'A colloquail term for money', 'Hold your bar');

        $this->assertEquals('A colloquail term for money', $this->dictionary->getData()['bar']['description']);

        $this->assertEquals('Hold your bar', $this->dictionary->getData()['bar']['sample-sentence']);
    }

    /** test five
    *
    * This one tests removeSlang
    */

    public function testRemoveSlang()
    {

        $this->dictionary->addSlang('bar', 'Term for money', 'Hold your bar');

        $this->dictionary->removeSlang('bar');

        $this->assertFalse(isset($this->dictionary->getData()['bar']));

    }

    /** test six
    *
    * Ranks test
    */

    public function testRankWords()
    {

        $word = $this->dictionary->rankWords("Prosper, have you finished the curriculum? Yes, tight tight tight");

        foreach( $word as $key => $value )
        {
            $this->assertArrayHasKey($key, $word);
            $this->assertEquals($value, $word[$key]);
        }

    }


    public function dataSource()
    {
        return array (

            array('wording', 'warning', 'you dont want wording')

        );
    }
}
