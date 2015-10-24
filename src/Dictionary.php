<?php

/**
* @author Florence Okosun <florence.okosun@andela.com>
* @copyright 2015 Andela
*/

namespace Florence;

use Florence\Exceptions\WordExistsException;
use Florence\Exceptions\WordNotFoundException;

class Dictionary {

    /**
    *@var $data
    */

    private $data;

    public function __construct() {
        $this->data = Data::$data;
    }

    public function getData() {
        return $this->data;
    }

    /**
    * @var boolean $arrayKeyExist
    * @param string $slang
    */

    public function arrayKeyExist($slang) {
        $arrayKeyExist = false;

        if (array_key_exists($slang, $this->data)) {
            $arrayKeyExist = true;
        }

        return $arrayKeyExist;
    }

    /**
    * @param string $slang
    * @param string $meaning
    * @param string $sentence
    * @var array $arr
    */

    public function addSlangToDictionary($slang, $meaning, $sentence) {
        if (! $this->arrayKeyExist($slang)) {
            $arr= [
                'description' => $meaning,
                'sample-sentence' => $sentence
            ];
            $this->data[$slang] = $arr;

            return $this->data;

        } else {
            throw new WordExistsException($slang.' already exists in the dictionary');
        }
    }

    /**
    * @param string $slang
    */

    public function deleteSlangFromDictionary($slang) {

        if ($this->arrayKeyExist($slang)) {
            unset($this->data[$slang]);

            return true;
        }

        throw new WordNotFoundException($slang.' not found in the dictionary');
    }

    /**
    * @param string $slang
    * @param string $meaning
    * @param string $sentence
    */

    public function updateExistingSlang($slang, $meaning, $sentence) {
        if ($this->arrayKeyExist($slang)) {
            $arr= [
                'description' => $meaning,
                'sample-sentence' => $sentence
            ];

            $this->data[$slang] = $arr;

            return true;
        }

        throw new WordNotFoundException($slang.' not found in the dictionary');
    }

    /**
    * @param string $slang
    */

    public function findAndRetrieveSlang($slang) {
        $result = $this->data[$slang];

        if (is_null($result)) {

            throw new WordNotFoundException($slang.' not found in the dictionary');
        }

        return $result;
    }

    /**
    * @param string $sentence
    * @var array $ranker
    */

    public function rankAndSort($sentence) {
        $ranker = [];
        $ranker = array_count_values(str_word_count(strtolower($sentence), 1));
        arsort($ranker);

        return $ranker;
    }

}
