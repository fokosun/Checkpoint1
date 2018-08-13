<?php

namespace Florence;

use Florence\Exceptions\WordExistsException;
use Florence\Exceptions\WordNotFoundException;

/**
 * Class Dictionary
 *
 * @package Florence
 */
class Dictionary {
    /**
     * Dictionary Data
     *
     * @var $_data
    */
    private $_data;

    /**
     * Class constructor
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
    public function findOne($slang)
    {
        if (! array_key_exists($slang, $this->_data)) {
            throw new WordNotFoundException (
                $slang.',: not found in the dictionary'
            );
        } else {
            $result = $this->_data;
        }

        return $result;
    }

    /**
     * Return All Slangs
     *
     * @return array
     */
    public function findAll()
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
    public function addSlang($slang = []) : array
    {
        if (array_key_exists($slang['title'], $this->_data)) {
            throw new WordExistsException(
                $slang . ': word already exists in the dictionary.'
            );
        } else {
            $contents = [
                'description'       => $slang['description'],
                'sample-sentence'   => $slang['sentence']
            ];

            $this->_data[$slang['title']] = $contents;

            $inserted = [
                'data'      => $this->_data
            ];
        }

        return $inserted;
    }

    /**
     * Delete a slang
     *
     * @param $slang
     *
     * @throws WordNotFoundException
     *
     * #return array
     */
    public function deleteOne($slang) : array
    {
        if (! array_key_exists($slang, $this->_data)) {
            throw new WordNotFoundException(
                $slang.', word not found in the dictionary'
            );
        } else {
            unset($this->_data[$slang]);

            $deleted = [
                'deleted' => true,
                'message' => 'Success',
                'data' => $this->_data
            ];
        }

        return $deleted;
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
    public function updateSlang($slang, $meaning, $sentence)
    {
        if (! array_key_exists($slang, $this->_data)) {
            throw new WordNotFoundException(
                $slang.', word not found in the dictionary'
            );
        } else {
            $arr = [
                'description'       => $meaning,
                'sample-sentence'   => $sentence
            ];

            $this->_data[$slang] = $arr;

            $updated = [
                'data' => $this->_data[$slang]
            ];
        }

        return $updated;
    }

    /**
     * Rank and Sort Dictionary
     *
     * @param string $sentence sample sentence
     *
     * @var array $ranker ranker
     *
     * @return array
     */
    public function rankAndSort($sentence)
    {
        $ranker = array_count_values(str_word_count(strtolower($sentence), 1));
        arsort($ranker);

        return $ranker;
    }
}
