<?php

class TilePath extends Tile{

    const EDGE_N = '^';
    const EDGE_E = '>';
    const EDGE_S = 'v';
    const EDGE_W = '<';

    protected $walkableEdges;

    protected $clockwiseMap = [     self::EDGE_N=>self::EDGE_E,
                                    self::EDGE_E=>self::EDGE_S,
                                    self::EDGE_S=>self::EDGE_W,
                                    self::EDGE_W=>self::EDGE_N];
    protected $antiClockwiseMap = [ self::EDGE_N=>self::EDGE_W,
                                    self::EDGE_W=>self::EDGE_S,
                                    self::EDGE_S=>self::EDGE_E,
                                    self::EDGE_E=>self::EDGE_N];

    

    public function __construct(array $walkableEdges = null){
        parent::__construct(Tile::TYPE_PATH);
        $this->walkableEdges = is_null($walkableEdges)?[]:$walkableEdges;
    }

    public function __toString(){
        //return parent::__toString().$this->toStringWalkableEdges();
        return "[".$this->type.(is_null($this->orientation)?' ':$this->orientation).$this->toStringWalkableEdges()."]";
    
    }

    public function toStringWalkableEdges(){
        $s = '';
        if(count($this->walkableEdges)===0){$s .= ' ';}
        if(count($this->walkableEdges)===2 && in_array(self::EDGE_N, $this->walkableEdges) && in_array(self::EDGE_S, $this->walkableEdges) ){$s .= '║';}
        if(count($this->walkableEdges)===2 && in_array(self::EDGE_W, $this->walkableEdges) && in_array(self::EDGE_E, $this->walkableEdges) ){$s .= '═';}
        if(count($this->walkableEdges)===2 && in_array(self::EDGE_N, $this->walkableEdges) && in_array(self::EDGE_E, $this->walkableEdges) ){$s .= '╚';}
        if(count($this->walkableEdges)===2 && in_array(self::EDGE_N, $this->walkableEdges) && in_array(self::EDGE_W, $this->walkableEdges) ){$s .= '╝';}
        if(count($this->walkableEdges)===2 && in_array(self::EDGE_S, $this->walkableEdges) && in_array(self::EDGE_E, $this->walkableEdges) ){$s .= '╔';}
        if(count($this->walkableEdges)===2 && in_array(self::EDGE_S, $this->walkableEdges) && in_array(self::EDGE_W, $this->walkableEdges) ){$s .= '╗';}
        return $s;
    }

}