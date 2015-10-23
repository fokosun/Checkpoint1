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
                'slang' => $slang,
                'description' => $meaning,
                'sample-sentence' => $sentence
            ];

            array_push($this->data, $arr);

            return $this->data;

        } else {
            throw new WordExistsException($slang . ' already exists in the dictionary');
        }
    }

    public function deleteSlangFromDictionary($slang) {

        $dataset = $this->data;
        $wordexists = false;

        for ($i=0; $i < count($dataset); $i++) {
            if($dataset[$i]["slang"] = $slang) {
                // $a = array_splice($dataset, $i, 1);
                $b = array_slice($dataset[$i], -1, 1);

                return $b;
            }
        }

        if(!$wordexists) {
            throw new WordNotFoundException($slang . ' not found in the dictionary');
        }
    }

    public function updateExistingSlang($slang, $meaning, $sentence) {

        if(! array_key_exists($slang, $this->data)) {
            throw new WordNotFoundException($slang . ' not found in the dictionary');
        } else {
            $update= [
                'slang' => $slang,
                'description' => $meaning,
                'sample-sentence' => $sentence
            ];

            array_push($this->data, $this->data = $update);

            return $this->data;
        }
    }

    public function findAndRetrieveSlang($slang) {

        if (array_key_exists($slang, $this->data)) {
            return $this->data[$slang];
        } else {
            throw new WordNotFoundException($slang . ' not found in the dictionary');
        }

    }

    public function rankAndSort($sentence) {
        $ranker = [];
        $ranker = array_count_values(str_word_count(strtolower($sentence),1));
        arsort($ranker);

        return $ranker;
    }

}
