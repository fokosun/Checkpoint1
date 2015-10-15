<?php

namespace Florence;

class Test {

    protected $t_name;

    public function __construct($t_name) {
        $this->t_name = $t_name;
    }

    public function getName(){
        return $this->t_name;
    }
}
