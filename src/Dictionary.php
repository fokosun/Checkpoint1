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
     * Get data property
     *
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * Set Data variable
     *
     * @param mixed $data data
     *
     * @return Dictionary
     */
    public function setData($data)
    {
        $this->_data = $data;

        return $this;
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
            if (! isset($this->_data[$slang])) {
                throw new WordNotFoundException(
                    $slang.' not found in the dictionary'
                );
            } else {
                $result = $this->_data[$slang];
            }
        } catch (Throwable $e) {
            $result = $e->getMessage();
        }

        return $result;
    }

    /**
     * Check if array key exists
     *
     * @param string $slang slang
     *
     * @var boolean $arrayKeyExist
     *
     * @return bool
    */
    public function arrayKeyExist($slang)
    {
        $arrayKeyExist = false;

        if (array_key_exists($slang, $this->_data)) {
            $arrayKeyExist = true;
        }

        return $arrayKeyExist;
    }

    /**
     * Add slang to dictionary
     *
     * @param string $slang    slang
     * @param string $meaning  meaning
     * @param string $sentence sample sentence
     *
     * @throws   WordExistsException
     * @internal param array $arr
     *
     * @return mixed
     */
    public function addSlangToDictionary($slang, $meaning, $sentence)
    {
        if (! $this->arrayKeyExist($slang)) {
            $arr= [
                'description' => $meaning,
                'sample-sentence' => $sentence
            ];
            $this->_data[$slang] = $arr;

            return $this->_data;

        } else {
            throw new WordExistsException(
                $slang.' already exists in the dictionary'
            );
        }
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
    public function deleteSlangFromDictionary($slang)
    {
        if ($this->arrayKeyExist($slang)) {
            unset($this->_data[$slang]);

            return true;
        }

        throw new WordNotFoundException($slang.' not found in the dictionary');
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
    public function updateExistingSlang($slang, $meaning, $sentence)
    {
        if ($this->arrayKeyExist($slang)) {
            $arr= [
                'description' => $meaning,
                'sample-sentence' => $sentence
            ];

            $this->_data[$slang] = $arr;

            return true;
        }

        throw new WordNotFoundException($slang.' not found in the dictionary');
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
        $ranker = [];
        $ranker = array_count_values(str_word_count(strtolower($sentence), 1));
        arsort($ranker);

        return $ranker;
    }
}
