<?php

namespace Florence\Test;

use Florence\Dictionary;

/**
 * Class DictionaryTest
 *
 * @package Florence\Test
 */
class DictionaryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that a slang can be added to the dictionary
     *
     * @return void
     */
    public function testAddSlangToDictionary()
    {
        $dict = new Dictionary();

        // fetches the temporary variable created in memory and stores in $fetched

        $data = $dict->add(
            'Buzzinga',
            'An exclamation of astonishment, originally used in "The X-Files"',
            'Yeah, Miley Cyrus is totally classy.... Buzzinga.'
        );

        $this->assertArrayHasKey('Buzzinga', $data['data']);
        $this->assertTrue($data['inserted']);
        $this->assertEquals('Success', $data['message']);
    }

    /**
     * Test that a slang that does not exist cannot be deleted
     *
     * @return void
    */
    public function testThatWordNotFoundCannotBeDeleted()
    {
        $dict = new Dictionary();

        $data = $dict->add(
            'Bezzinga',
            'An exclamation of astonishment, originally used in "The X-Files"',
            'Yeah, Miley Cyrus is totally classy.... Buzzinga.'
        );

        $this->assertFalse($dict->delete('Buzzinga')['deleted']);
        $this->assertEquals('Success', $data['message']);
    }

    /**
     * Test that a slang that exists can be deleted from the dictionary
     *
     * @return void
     */
    public function testThatWordFoundCanBeDeleted()
    {
        $dict = new Dictionary();

        $this->assertTrue($dict->delete('Tight')['deleted']);
    }

    /**
     * Test that a slang that does not exist cannot be updated
     *
     * @return void
    */
    public function testThatWordNotFoundCannotBeUpdated()
    {
        $dict = new Dictionary();

        $dict->add(
            'chop', 'to eat or pieces', 'get those chops and chop them off'
        );

        $this->assertFalse(
            $dict->update(
                'chopsticks', 'chinese cutlery', 'chop sticks for chop'
            )['updated']
        );
    }

    /**
     * Test that existing slang can be updated
     *
     * @return void
     */
    public function testThatExistingSlangCanBeUpdated()
    {
        $dict = new Dictionary();

        $dict->add(
            'chop', 'to eat or pieces', 'get those chops and chop them off'
        );

        $this->assertTrue(
            $dict->update(
                'chop', 'chinese cutlery', 'chop sticks for chop'
            )['updated']
        );
    }

    /**
     * Test that slang added can be found
     *
     * @return void
     */
    public function testSlangAddedCanBeFound()
    {
        $dict = new Dictionary();

        $dict->add('chop', 'to eat or pieces', 'get those chops and chop them off');

        $result = $dict->find('chop');

        $this->assertArrayHasKey('chop', $result);
    }

    /**
     * Test that slang not added cannot be found
     *
     * @return void
     */
    public function testSlangNotAddedCannotBeFound()
    {
        $dict = new Dictionary();

        $result = $dict->find('buzzinger');

        $this->assertEquals('buzzinger, word not found in the dictionary', $result);
    }

    /**
     * Rank and sort sentence
     *
     * @return void
     */
    public function testRankAndSort()
    {
        $dict = new Dictionary();

        $sentence = 'Andrei: Prosper prosper prosper, are you done with
        the curriculum yet? Prosper: yes Andrei: Oh tight tight tight!';

        $ranker = [
            "prosper" => "4",
            "tight" => "3",
            "andrei" => "2",
            "yet" => "1",
            "oh" => "1",
            "curriculum" => "1",
            "yes" => "1",
            "with" => "1",
            "are" => "1",
            "you" => "1",
            "done" => "1",
            "the" => "1"
        ];

        $this->assertEquals($ranker, $dict->rankAndSort($sentence));
    }
}
