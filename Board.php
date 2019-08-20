<?php

class Board {

    protected $model = null;
    protected $house = null;

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
        $this->house = $this->model[$x][$y];
        $this->house->setXY($x, $y);
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
        echo "VAL: Door is ".($this->isHouseDoorUnblocked()?'Unb':'B')."locked".PHP_EOL;
        echo "VAL: Door IS".($this->isHouseDoorNextToPath()?'':' NOT')." NEAR to path".PHP_EOL;
        $this->currentTile = $this->house;
        do{
            $this->nextTile = $this->calculateNextTile();
            $this->validatePathsMatch();
        }while($this->nextTile->getType!=Tile::TYPE_LRRH);

    }

    public function calculateNextTile(){

    }

    public function isHouseDoorUnblocked(){
        $h = $this->house;
        $o = $h->getOrientation();
        $x = $h->getX();
        $y = $h->getY();
        if ($x==0 && $o == Tile::ORIENTATION_N) return false;
        if ($x==3 && $o == Tile::ORIENTATION_S) return false;
        if ($y==0 && $o == Tile::ORIENTATION_W) return false;
        if ($y==3 && $o == Tile::ORIENTATION_E) return false;
        return true;
    }

    public function isHouseDoorNextToPath(){
        $h = $this->house;
        $o = $h->getOrientation();
        $x = $h->getX();
        $y = $h->getY();
        $nextToDoorX = $x;
        $nextToDoorY = $y;
        if ($o == Tile::ORIENTATION_N) $nextToDoorX = $x - 1;
        if ($o == Tile::ORIENTATION_S) $nextToDoorX = $x + 1;
        if ($o == Tile::ORIENTATION_W) $nextToDoorY = $y - 1;
        if ($o == Tile::ORIENTATION_E) $nextToDoorY = $y + 1;
        if($this->model[$nextToDoorX][$nextToDoorY]->getType() == Tile::TYPE_PATH)
            return true;
        return false;
    }

    public function getModel(){
        return $this->model;
    }
    
}