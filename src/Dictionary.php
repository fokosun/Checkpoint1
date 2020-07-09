<?php

namespace Florence;

use Florence\Exceptions\WordExistsException;
use Florence\Exceptions\WordNotFoundException;

class Dictionary {

    /**
     * Dictionary Data
     *
     * @var $_data
    */
    private $_data;

    /**
     * Load data into Dictionary instance
     */
    public function __construct()
    {
        $this->_data = Data::$data;
    }

    /**
     * Find Slang in dictionary
     *
     * @param $slang
     * @throws WordNotFoundException
     *
     * @return array
     */
    public function findOne($slang): array
    {
        if (!array_key_exists($slang, $this->_data)) {
            throw new WordNotFoundException (
                $slang.',: not found in the dictionary'
            );
        }

        return $this->_data;
    }

    /**
     * Return All Slangs
     */
    public function findAll(): array
    {
        return $this->_data;
    }

    /**
     * Add a new slang
     *
     * @param array $slang
     *
     * @throws WordExistsException
     *
     * @return array
     */
    public function addSlang($slang = []): array
    {
        if (array_key_exists($slang['title'], $this->_data)) {
            throw new WordExistsException(
                $slang . ': word already exists in the dictionary.'
            );
        }

		$contents = [
			'description'       => $slang['description'],
			'sample-sentence'   => $slang['sentence']
		];

		$this->_data[$slang['title']] = $contents;

		return ['data' => $this->_data];
    }

	/**
	 * Delete a slang
	 *
	 * @param $slang
	 *
	 * @return array
	 * @throws WordNotFoundException
	 */
    public function deleteOne($slang) : array
    {
        if (! array_key_exists($slang, $this->_data)) {
            throw new WordNotFoundException(
                $slang.', word not found in the dictionary'
            );
        }
		unset($this->_data[$slang]);

		return [
			'deleted' => true,
			'message' => 'Success',
			'data' => $this->_data
		];
    }

    /**
     * Destroy all slangs
     *
     * @return boolean
     */
    public function deleteAll()
    {
        unset($this->_data);

        return true;
    }

    /**
     * Update a Slang
     *
     * @param $slang
     * @param $meaning
     * @param $sentence
     *
     * @throws WordNotFoundException
     *
     * @return array
     */
    public function updateSlang($slang, $meaning, $sentence): array
    {
        if (! array_key_exists($slang, $this->_data)) {
            throw new WordNotFoundException(
                $slang.', word not found in the dictionary'
            );
        }

		$arr = [
			'description'       => $meaning,
			'sample-sentence'   => $sentence
		];

		$this->_data[$slang] = $arr;

		return [
			'data' => $this->_data[$slang]
		];
    }

	/**
	 * Rank and Sort Dictionary
	 *
	 * @param string $sentence sample sentence
	 *
	 * @return array
	 */
	public function rankAndSort($sentence): array
    {
        $ranker = array_count_values(str_word_count(strtolower($sentence), 1));
        arsort($ranker);

        return $ranker;
    }
}
