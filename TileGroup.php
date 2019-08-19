<?php

class TileGroup{

    const ORIENTATION_N = '^';
    const ORIENTATION_E = '>';
    const ORIENTATION_S = 'v';
    const ORIENTATION_W = '<';
    const DEFAULT_ORIENTATION = self::ORIENTATION_N;

    protected $tiles;
    protected $orientation;

    public function __construct(array $tiles = null){
        $this->tiles = is_null($tiles)?[]:$tiles;;
        $this->orientation = self::DEFAULT_ORIENTATION;
    }

    public function addTile(Tile $tile){
        $this->tiles[] = $tile;
    }

    public function getTiles(){
        return $this->tiles;
    }

    public function __toString(){
        $s = "(".$this->orientation.") ";
        foreach($this->tiles as $tile){
            $s .= $tile;
        }
        return $s.PHP_EOL;
    }

    public static function generateOriginalPathsTileGroups(){
        return [                    
                new TileGroup([
                                new TilePath([TilePath::EDGE_S, TilePath::EDGE_W]), 
                                new TilePath([])
                ]),
                new TileGroup([
                                new TilePath([TilePath::EDGE_N, TilePath::EDGE_E]), 
                                new TilePath([TilePath::EDGE_N, TilePath::EDGE_S])
                ]),
                new TileGroup([
                                new TilePath([TilePath::EDGE_N, TilePath::EDGE_E]), 
                                new TilePath([TilePath::EDGE_E, TilePath::EDGE_S])
                ]),
                new TileGroup([
                                new TilePath([TilePath::EDGE_N, TilePath::EDGE_S]), 
                                new TilePath([TilePath::EDGE_N, TilePath::EDGE_S])
                ]),
                new TileGroup([
                                new TilePath([TilePath::EDGE_N, TilePath::EDGE_E]), 
                                new TilePath([TilePath::EDGE_W, TilePath::EDGE_S])
                ])
        ];
    }

}