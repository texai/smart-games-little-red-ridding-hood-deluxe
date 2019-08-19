<?php

class Tile {
    
    const TYPE_EMPTY = ' ';
    const TYPE_HOUSE = 'H';
    const TYPE_LRRH = 'L';
    const TYPE_TREE = 'T';
    const TYPE_PATH = '#';

    const ORIENTATION_N = '^';
    const ORIENTATION_E = '>';
    const ORIENTATION_S = 'v';
    const ORIENTATION_W = '<';

    protected $type;
    protected $orientation;

    static $valid_orientations = [self::ORIENTATION_N, self::ORIENTATION_E, self::ORIENTATION_S, self::ORIENTATION_W];

    public function __construct($type){
        $this->type = $type;
    }

    public function getType(){
        return $this->type;
    }

    public function isEmpty(){
        return $this->getType()==self::TYPE_EMPTY;
    }

    public static function create($type = self::TYPE_EMPTY){
        return new self($type);
    }

    public function setRandomOrientation(){
        $this->orientation = static::$valid_orientations[rand(0,3)];
        return $this;
    }

    public function __toString(){
        return "[".$this->type.(is_null($this->orientation)?' ':$this->orientation)." ]";
    }

}