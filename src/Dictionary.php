<?php

namespace Florence;

use \InvalidArgumentException;

class Dictionary {

    private $data;

    public function __construct() {
        $this->data = Data::$data;
    }

    public function getData() {
        return $this->data;
    }

    public function addSlangToDictionary($slang, $meaning, $sentence) {

        // $numargs = func_num_args();

        // $exit_code = false;

        if(! array_key_exists($slang, $this->data)) {
            $this->data[$slang] = [
                'slang' => $slang,
                'description' => $meaning,
                'sample-sentence' => $sentence
            ];

            // $exit_code = true;
            return $this->data;

        } else {
            // throw new WordExistsException( $slang . ' already exists in the dictionary' );
            throw new InvalidArgumentException($slang . ' already exists in the dictionary');
        }

    }


    public function deleteSlangFromDictionary($slang) {

        if(array_key_exists($slang, $this->data)) {

            unset ( $this->data[$slang] );

            return $this->data;

        } else {

            throw new InvalidArgumentException($slang . ' not found in the dictionary');
        }

    }

    public function updateExistingSlang($slang, $meaning, $sentence) {

        if(array_key_exists($slang, $this->data)) {

            $this->data[$slang] = [
                'slang' => $slang,
                'description' => $meaning,
                'sample-sentence' => $sentence
            ];

            return $this->data;

        } else {

            throw new InvalidArgumentException($slang . ' not found in the dictionary');

        }
    }

    public function findAndRetrieveSlang( $slang ) {

        if ( array_key_exists($slang, $this->data) ) {
            return $this->data[$slang];
        } else {
            throw new InvalidArgumentException($slang . ' not found in the dictionary');
        }

    }

    public function rankAndSort($sentence) {

        $ranker = [];

        $ranker = (array_count_values(str_word_count(strtolower($sentence),1)));

        arsort($ranker);

        return $ranker;
    }

}
