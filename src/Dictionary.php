<?php

namespace Florence;

use InvalidArgumentException;

class Dictionary
{

    private $data;

    /**
    * Initialize the constructor
    */

    public function __construct( $init )
    {

        if( !(isset( $init )) )
        {
            $this->data = Data::$data;
        }

        $this->data = $init;

    }

    /**
    * Set Data
    */

    public function setData( $data )
    {

        $this->data = $data;

    }

    /**
    * Return the data
    */

    public function getData()
    {

        return $this->data;

    }

    /**
    * Adds a slang, it's description and sample sentence to the dictionary array in the
    * Data class.
    */

    public function addSlang( $slang, $description, $sentence )
    {

        if(! array_key_exists($slang, $this->data))
        {
            $this->data[$slang] = [
                'slang' => $slang,
                'description' => $description,
                'sample-sentence' => $sentence
            ];
        }
        else
        {
            throw new WordExistsException( $slang . ' already exists in the dictionary' );
        }

    }

    /**
    * Updates the description and sample sentence of a word in the dictionary array of the
    * Data class.
    */

    public function updateSlang( $slang, $description, $sentence )
    {

        $data = $this->data[$slang];

        if( array_key_exists($slang, $this->data) )
        {
            $data['description'] = $description;
            $data['sample-sentence'] = $sentence;
            $this->data[$slang] = $data;
        }
        else
        {
            throw new WordNotFoundException($slang . ' not found in the dictionary');
        }
    }

    /**
    * Get the full detail of a slang that is added to the dictionary array
    */

    public function findSlang( $slang )
    {

        if( array_key_exists( $slang, $this->data) )
        {
            return $this->data[$slang];
        }
        else
        {
            throw new WordNotFoundException( $slang . ' not found in the dictionary' );
        }

    }

    /**
    * Remove a slang and it's attributes from the dictionary array
    */

    public function removeSlang( $slang )
    {

        if( array_key_exists( $slang, $this->data) )
        {
            unset ( $this->data[$slang] );
        }
        else
        {
            throw new WordNotFoundException( $slang . ' not found in the dictionary' );
        }

    }

    /**
    * Group the same words according to the number of occurrences in a given sentence.
    */

    public function rankWords( $sentence )
    {

        $words = str_word_count( $sentence, 1 );
        $ranking = [];
        $tag = [];
        $count = [];

        foreach( $words as $word )
        {
            if( isset($ranking[strtolower( $word )]) )
            {
                $ranking[strtolower( $word )]++;
            }
            else
            {
                $ranking [strtolower( $word )] = 1;
            }
        }

        $this->sortWords($ranking);

        return $ranking;

    }

    private function sortWords( $ranking )
    {

        if(! is_array( $ranking ))
        {
            throw new InvalidArgumentException("The method argument must be of type array");
        }

        foreach( $ranking as $key => $value )
        {
            $tag [] = $key;
            $count [] = $value;
        }

        array_multisort($ranking );

    }

}
