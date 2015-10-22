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

        //get all the slangs and put em in $existing array

        // $existing = [];

        // foreach($dictionary->getData() as $innerrow) {
        //     foreach($innerrow as $key) {
        //         $m=($innerrow['Slang']);
        //     }
        //     array_push($existing, $m);
        // }

        // //Check if slang already exist

        // if (! in_array(strtolower($slang), strtolower($existing)) ) {

        //     //Go ahead and add the new slang

            $add = ["Slang" => $slang, "Meaning" => $meaning, "Sentence" => $sentence];

        //     array_push($this->data, $add);

        // }

        // else {

        //     //Throw an error

        // }
    }
}
