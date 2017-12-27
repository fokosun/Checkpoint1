<?php

declare (strict_types=1);

namespace Florence;

use Throwable;
use Florence\Exceptions\WordExistsException;
use Florence\Exceptions\WordNotFoundException;

/**
 * Class Dictionary
 *
 * @package Florence
 */
class Dictionary
{
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
     * @param string $slang keyword
     *
     * @return mixed
     */
    public function find(string $slang)
    {
        try {
            if (! array_key_exists($slang, $this->_data)) {
                throw new WordNotFoundException(
                    $slang.', word not found in the dictionary'
                );
            } else {
                $result = $this->_data;
            }
        } catch (Throwable $e) {
            $result = $e->getMessage();
        }

        return $result;
    }

    /**
     * Add slang to dictionary
     *
     * @param string $slang    slang
     * @param string $meaning  meaning
     * @param string $sentence sample sentence
     *
     * @return mixed
     */
    public function add(string $slang, string $meaning, string $sentence) : array
    {
        try {
            if (array_key_exists($slang, $this->_data)) {
                throw new WordExistsException(
                    $slang.', word already exists in the dictionary.'
                );
            } else {
                $contents = [
                    'description' => $meaning,
                    'sample-sentence' => $sentence
                ];

                $this->_data[$slang] = $contents;

                $inserted = [
                    'inserted' => true,
                    'message' => 'Success',
                    'data' => $this->_data
                ];
            }
        } catch (Throwable $e) {
            $inserted = [
                'inserted' => false,
                'message' => $e->getMessage(),
                'data' => $this->_data
            ];
        }

        return $inserted;
    }

    /**
     * Delete slang from Dictionary
     *
     * @param string $slang slang
     *
     * @throws WordNotFoundException
     *
     * @return mixed
     */
    public function delete(string $slang) : array
    {
        try {
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
        } catch (Throwable $e) {
            $deleted = [
                'deleted' => false,
                'message' => $e->getMessage(),
                'data' => $this->_data
            ];
        }

        return $deleted;
    }

    /**
     * Update existing slang in dictionary
     *
     * @param string $slang    slang
     * @param string $meaning  meaning
     * @param string $sentence sample sentence
     *
     * @throws WordNotFoundException
     *
     * @return mixed
     */
    public function update(string $slang, string $meaning, string $sentence)
    {
        try {
            if (! array_key_exists($slang, $this->_data)) {
                throw new WordNotFoundException(
                    $slang.', word not found in the dictionary'
                );
            } else {
                $arr = [
                    'description' => $meaning,
                    'sample-sentence' => $sentence
                ];

                $this->_data[$slang] = $arr;

                $updated = [
                    'updated' => true,
                    'message' => 'Success',
                    'data' => $this->_data
                ];
            }
        } catch (Throwable $e) {
            $updated = [
                'updated' => false,
                'message' => $e->getMessage(),
                'data' => $this->_data
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
