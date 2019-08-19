<?php

class ChallengesGenerator {

    public static function run(){
        $board = new Board();
        $board->setHouseRandomly();
        $board->setLrrhRandomly();
        $board->setTreesRandomly();
        $board->setPathRandomly();
        echo $board;
        $board->validate();
    }

}