<?php

namespace Florence;

use Florence\Exceptions\WordExistsException;
use Florence\Exceptions\WordNotFoundException;

class Dictionary {

    private $data;

    public function __construct() {
        $this->data = Data::$data;
    }

    public function getData() {
        return $this->data;
    }

    public function arrayKeyExist($slang) {
        $arrayKeyExist = false;

        if(array_key_exists($slang, $this->data)) {
            $arrayKeyExist = true;
        }

        return $arrayKeyExist;
    }

    public function addSlangToDictionary($slang, $meaning, $sentence) {
        if(! $this->arrayKeyExist($slang)) {
            $arr= [
                'description' => $meaning,
                'sample-sentence' => $sentence
            ];

            $this->data[$slang] = $arr;

            return $this->data;

        } else {
            throw new WordExistsException($slang . ' already exists in the dictionary');
        }
    }

    public function deleteSlangFromDictionary($slang) {

        if($this->arrayKeyExist($slang)) {
            unset($this->data[$slang]);

            return true;
        }

        throw new WordNotFoundException($slang . ' not found in the dictionary');
    }

    public function updateExistingSlang($slang, $meaning, $sentence) {
        if($this->arrayKeyExist($slang)) {
            $arr= [
                'description' => $meaning,
                'sample-sentence' => $sentence
            ];

            $this->data[$slang] = $arr;

            return true;

        }

        throw new WordNotFoundException($slang . ' not found in the dictionary');
    }

    public function findAndRetrieveSlang($slang) {
        $result = $this->data[$slang];

        if(is_null($result)) {

            throw new WordNotFoundException($slang . ' not found in the dictionary');
        }

        return $result;
    }

    public function rankAndSort($sentence) {
        $ranker = [];
        $ranker = array_count_values(str_word_count(strtolower($sentence),1));
        arsort($ranker);

        return $ranker;
    }

}
