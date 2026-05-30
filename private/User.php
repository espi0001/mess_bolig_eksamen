<?php

class User {

    public $name;

    public function __construct($_name) {
        $this->name = $_name;
    }

    public function greet() {
        echo "Hi, $this->name";
    }
}
