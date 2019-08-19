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
    protected $x;
    protected $y;

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

    public function setXY($x,$y){
        $this->x = $x;
        $this->y = $y;
        return $this;
    }

    public function getX(){
        return $this->x;
    }

    public function getY(){
        return $this->y;
    }

    public function getOrientation(){
        return $this->orientation;
    }

}