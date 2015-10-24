<?php

/**
* @author Florence Okosun <florence.okosun@andela.com>
* @copyright 2015 Andela
*/

namespace Florence\Exceptions;

class WordExistsException extends \Exception {

    /**
    * @var string $message
    */

    protected $message;

    public function __construct($message) {
        $this->message = $message;
    }

    public function getExceptionMessage() {
        return $this->message;
    }
}
