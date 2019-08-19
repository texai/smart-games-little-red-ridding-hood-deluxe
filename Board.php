<?php

class Board {

    protected $model = null;

    public function __construct(){
        $this->model = [[Tile::create(),Tile::create(),Tile::create(),Tile::create()],
                        [Tile::create(),Tile::create(),Tile::create(),Tile::create()],
                        [Tile::create(),Tile::create(),Tile::create(),Tile::create()],
                        [Tile::create(),Tile::create(),Tile::create(),Tile::create()]];

    }
    
    public function __toString(){
        $s = '';
        foreach ($this->model as $row){
            foreach ($row as $cell){
                $s .= $cell;
            }
            $s .= PHP_EOL;
        }
        return $s;
    }

    public function setHouseRandomly(){
        do{
            $x = rand(0,3);
            $y = rand(0,3);
        }while(!$this->model[$x][$y]->isEmpty());
        $this->model[$x][$y] = Tile::create(Tile::TYPE_HOUSE)->setRandomOrientation();
    }

    public function setLrrhRandomly(){
        do{
            $x = rand(0,3);
            $y = rand(0,3);
        }while(!$this->model[$x][$y]->isEmpty());
        $this->model[$x][$y] = Tile::create(Tile::TYPE_LRRH);
    }

    public function setTreeRandomly(){
        do{
            $x = rand(0,3);
            $y = rand(0,3);
        }while(!$this->model[$x][$y]->isEmpty());
        $this->model[$x][$y] = Tile::create(Tile::TYPE_TREE);
    }

    public function setPathRandomly(){

        $originalPaths = TileGroup::generateOriginalPathsTileGroups();
        
        do{
            $randomIndex = array_rand($originalPaths);
            $randomOriginalPathTileGroup = $originalPaths[$randomIndex];
            $x = rand(0,3);
            $y = rand(0,3);
        }while( $x==0 || !$this->model[$x][$y]->isEmpty() || !$this->model[$x-1][$y]->isEmpty() );
        $tilesPath = $randomOriginalPathTileGroup->getTiles();
        $this->model[$x][$y] = $tilesPath[0];
        $this->model[$x-1][$y] = $tilesPath[1];

        do{
            $randomIndex2 = array_rand($originalPaths);
            $randomOriginalPathTileGroup = $originalPaths[$randomIndex2];
            $x = rand(0,3);
            $y = rand(0,3);
        }while( $randomIndex==$randomIndex2 || $x==0 || !$this->model[$x][$y]->isEmpty() || !$this->model[$x-1][$y]->isEmpty() );
        $tilesPath = $randomOriginalPathTileGroup->getTiles();
        $this->model[$x][$y] = $tilesPath[0];
        $this->model[$x-1][$y] = $tilesPath[1];

    }

    public function setTreesRandomly(){
        $this->setTreeRandomly();
        $this->setTreeRandomly();
        $this->setTreeRandomly();
    }

    public function validate(){

        return true;
    }

    public function getModel(){
        return $this->model;
    }
    
}