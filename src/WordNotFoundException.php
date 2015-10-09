<?php

namespace Florence;

use Exception;

class WordNotFoundException extends Exception
{
	protected $message;

	public function __construct($message)
	{
		$this->message = $message;
	}

	public function getExceptionMessage()
	{
		return $this->message;
	}
}