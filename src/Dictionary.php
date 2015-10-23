<?php

namespace Florence;

use Florence\WordExistsException;
use Florence\WordNotFoundException;

class Dictionary {

    private $data;

    public function __construct() {
        $this->data = Data::$data;
    }

    public function getData() {
        return $this->data;
    }

    public function addSlangToDictionary($slang, $meaning, $sentence) {
        if(! array_key_exists($slang, $this->data)) {
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

        if(array_key_exists($slang, $this->data)) {
            unset($this->data[$slang]);

            return true;
        }
        throw new WordNotFoundException($slang . ' not found in the dictionary');
    }

    public function updateExistingSlang($slang, $meaning, $sentence) {
        if(array_key_exists($slang, $this->data)) {
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


        $res = $this->data[$slang];
        if(is_null($res)) {
            throw new WordNotFoundException($slang . ' not found in the dictionary');
        }

        return $res;
    }

    public function rankAndSort($sentence) {
        $ranker = [];
        $ranker = array_count_values(str_word_count(strtolower($sentence),1));
        arsort($ranker);

        return $ranker;
    }

}
