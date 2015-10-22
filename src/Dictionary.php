<?php

namespace Florence;

use Florence\Data;

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
            $this->data[$slang] = [
                'slang' => $slang,
                'description' => $meaning,
                'sample-sentence' => $sentence
            ];
        } else {
            throw new WordExistsException( $slang . ' already exists in the dictionary' );
        }

    }

    public function deleteSlangFromDictionary($slang) {

        if(array_key_exists($slang, $this->data)) {

            unset ( $this->data[$slang] );

        }

        } else {

            throw new WordNotFoundException( $slang . 'word not found in the dictionary' );
        }

    }

    public function updateExistingSlang($slang, $meaning, $sentence) {

        if(array_key_exists($slang, $this->data)) {

            $this->data[$slang] = [
                'slang' => $slang,
                'meaning' => $meaning,
                'sentence' => $sentence
            ];

        } else {

            throw new WordNotFoundException( $slang . 'word not found in the dictionary' );
        }
    }

    public function findAndRetrieveSlang( $slang ) {

        if( array_key_exists($slang, $this->data) ) {
            return $this->data[$slang];
        } else {
            throw new WordNotFoundException( $slang . ' word not found in the dictionary' );
        }

    }

    public function rankAndSort($sentence) {

        $unsorted = [];
        $sorted = [];

        $unsorted = (array_count_values(str_word_count(strtolower($sentence),1)));

        arsort($unsorted);

        foreach($unsorted as $key => $val) {
            $word = $key;
            $count = $val;
            array_push($sorted,[$word => $count]);
        }

        return $sorted;
    }

}
