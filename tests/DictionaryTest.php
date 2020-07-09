<?php

namespace Florence\Test;

use Florence\Dictionary;
use PHPUnit\Framework\TestCase;
use Florence\Exceptions\WordNotFoundException;

/**
 * Class DictionaryTest
 *
 * @package Florence\Test
 */
class DictionaryTest extends TestCase {

	/**
	 * @test
	 */
    public function testAddSlangToDictionary() {
        $dict = new Dictionary();

        $slang = [
            'title' => 'Buzzinga',
            'description' => 'An exclamation of astonishment, originally used in "The X-Files"',
            'sentence' => 'Yeah, Miley Cyrus is totally classy.... Buzzinga.'
        ];

        $data = $dict->addSlang($slang);

        $this->assertArrayHasKey('Buzzinga', $data['data']);
    }

    /**
     * @test
     */
    public function testThatWordNotFoundCannotBeDeleted()
    {
    	$this->expectException(WordNotFoundException::class);
        $dict = new Dictionary();

        $slang = [
            'title' => 'Bezzinga',
            'description' => 'An exclamation of astonishment, originally used in "The X-Files"',
            'sentence' => 'Yeah, Miley Cyrus is totally classy.... Buzzinga.'
        ];

        $dict->addSlang($slang);

        $this->assertFalse($dict->deleteOne('Buzzinga')['deleted']);
    }

	/**
	 * @test
	 */
    public function testThatWordFoundCanBeDeleted()
    {
        $dict = new Dictionary();

        $this->assertTrue($dict->deleteOne('Tight')['deleted']);
    }

    /**
     * @test
     */
    public function testThatWordNotFoundCannotBeUpdated()
    {
    	$this->expectException(WordNotFoundException::class);
        $dict = new Dictionary();

        $slang = [
            'title' => 'chop',
            'description' => 'to eat or pieces',
            'sentence' => 'get those chops and chop them off'
        ];

        $dict->addSlang($slang);

        $this->assertFalse(
            $dict->updateSlang(
                'chopsticks', 'chinese cutlery', 'chop sticks for chop'
            )['updated']
        );
    }

	/**
	 * @test
	 */
    public function testThatExistingSlangCanBeUpdated()
    {
        $dict = new Dictionary();

        $slang = [
            'title' => 'chop',
            'description' => 'to eat or pieces',
            'sentence' => 'get those chops and chop them off'];

        $dict->addSlang($slang);

        $updated = $dict->updateSlang(
            'chop', 'chinese cutlery', 'chop sticks for chop'
        );

        $this->assertSame('chinese cutlery', $updated['data']['description']);
        $this->assertSame('chop sticks for chop', $updated['data']['sample-sentence']);
    }

	/**
	 * @test
	 */
    public function testSlangAddedCanBeFound()
    {
        $dict = new Dictionary();

        $slang = [
            'title' => 'chop',
            'description' => 'to eat or pieces',
            'sentence' => 'get those chops and chop them off'
        ];

        $dict->addSlang($slang);

        $result = $dict->findOne('chop');

        $this->assertArrayHasKey('chop', $result);
        $this->assertSame($slang['description'], end($result)['description']);
        $this->assertSame($slang['sentence'], end($result)['sample-sentence']);
    }

    /**
     * @test
     */
    public function testSlangNotAddedCannotBeFound()
    {
    	$this->expectException(WordNotFoundException::class);
        $dict = new Dictionary();

        $dict->findOne('buzzinger');
    }

	/**
	 * @test
	 */
    public function testRankAndSort()
    {
        $dict = new Dictionary();

        $sentence = 'Andrei: Prosper prosper prosper, are you done with
        the curriculum yet? Prosper: yes Andrei: Oh tight tight tight!';

        $ranker = [
            "prosper"       => "4",
            "tight"         => "3",
            "andrei"        => "2",
            "yet"           => "1",
            "oh"            => "1",
            "curriculum"    => "1",
            "yes"           => "1",
            "with"          => "1",
            "are"           => "1",
            "you"           => "1",
            "done"          => "1",
            "the"           => "1"
        ];

        $this->assertEquals($ranker, $dict->rankAndSort($sentence));
    }

	/**
	 * @test
	 */
    public function testFindAll()
    {
        $dict = new Dictionary();
        $all = $dict->findAll();

        $this->assertGreaterThanOrEqual(0, count($all));
    }

	/**
	 * @test
	 */
    public function testDelteAll()
    {
        $dict = new Dictionary();
        $delete_all = $dict->deleteAll();

        $this->assertTrue($delete_all);
    }
}
