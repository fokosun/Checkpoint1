<?php

namespace Florence;

class DictionaryTest extends \PHPUnit_Framework_TestCase
{
    protected $dictionary;

    protected function setUp()
    {
        $this->dictionary = new Dictionary(Data::$data);
    }


    /** test one
    * @dataProvider dataSource
    *
    */

    public function testSampleSentenceContainsSlang($slang, $meaning, $sentence)
    {
        $result = array($slang, $sentence);
        $this->assertContains($slang, $sentence);
    }

    /** test two
    * @dataProvider dataSource
    *
    */

    public function testSampleSentenceNotEmpty($slang, $sentence)
    {
        $result = array($slang, $sentence);
        $this->assertNotEmpty($slang, $sentence);
    }

    /** test three
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

    /** test four
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

    /** test five
    * tests for updateSlang
    */

    public function testUpdateSlang()
    {

        $this->dictionary->addSlang('bar', 'Term for money', 'Hold your bar');

        $this->dictionary->updateSlang('bar', 'A colloquail term for money', 'Hold your bar');

        $this->assertEquals('A colloquail term for money', $this->dictionary->getData()['bar']['description']);

        $this->assertEquals('Hold your bar', $this->dictionary->getData()['bar']['sample-sentence']);
    }

    /** test six
    *
    * This one tests removeSlang
    */

    public function testRemoveSlang()
    {

        $this->dictionary->addSlang('bar', 'Term for money', 'Hold your bar');

        $this->dictionary->removeSlang('bar');

        $this->assertFalse(isset($this->dictionary->getData()['bar']));

    }

    /** test seven
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

    /* Datasource used for testing */

    public function dataSource()
    {
        return array (

            array('wording', 'warning', 'you dont want wording')

        );
    }
}
