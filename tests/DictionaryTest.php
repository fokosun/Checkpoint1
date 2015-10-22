<?php

namespace Florence;

class DictionaryTest extends \PHPUnit_Framework_TestCase
{
    protected $dictionary;

    protected function setUp()
    {
        $this->dictionary = new Dictionary(Data::$data);
    }


    public function testDictionaryIsNotEmpty()
    {
        $this->assertNotEmpty(array($this->dictionary->getData()));
    }

    /**
    * @dataProvider dataSource
    */
    public function testSampleSentenceContainsSlang($slang, $meaning, $sentence)
    {
        $result = array($slang, $sentence);
        $this->assertContains($slang, $sentence);
    }

    /* Data provider for testSampleSentenceContainsSlang */

    public function dataSource()
    {
        return array (
            array('wording', 'warning', 'you dont want wording')
        );
    }

    /**
    * @dataProvider slangsArrayDataSource
    * This one tests push operation
    */

    public function testArrayContainsSlang($slangs)
    {
        $this->assertContains('Crash',  ($slangs));
    }

    /* This is the data provider */

    public function slangsArrayDataSource() {

    $array = [

        [
            "Slang"           => "Tight",
            "Description"     => "When someone performs an awesome task.",
            "Sample-sentence" => "Prosper, you have finished the curriculum, Yes? Tight, Tight, Tight!!!"
        ],

        [
            "Slang"           => "Crash",
            "Description"     => "To sleep in an unusual location.",
            "Sample-sentence" => "It's been a while since I crashed at a friend's, Can I crash at your place?"
        ],

        [
            "Slang"           => "Lift",
            "Description"     => "To steal an item",
            "Sample-sentence" => "Seyi still can't believe Amitab could lift her phone."
        ],

        [
            "Slang"           => "Oshey",
            "Description"     => "Colloquial way of showing appreciation",
            "Sample-sentence" => "Oshey! Oshey! Oshey!, my tests are passing."
        ],

        [
            "Slang"           => "Grab",
            "Description"     => "A way of describing a girl's physique",
            "Sample-sentence" => "Oh boy, this babe grab grab die oh!."
        ],

    ];

    $slangs=[];

    foreach ($array as $row => $innerArray) {

        $res[] = $innerArray['Slang'];
    }

    array_push($slangs, $res);

        return
            array($slangs);
    }

    /**
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

    /**
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



}
