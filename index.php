<?php
spl_autoload_register(function ($class_name) {include $class_name . '.php';});

ChallengesGenerator::run();

#simulateCycles();
function simulateCycles(){

    function mt(){list($usec,$sec)=explode(" ", microtime());return((float)$usec+(float)$sec);}
    $mtStart = mt();
    $c = 0;
    foreach (range(1,16*4) as $key => $value) { // house 
        foreach (range(1,15) as $key => $value) { // tree1
            foreach (range(1,14) as $key => $value) { //tree2
                foreach (range(1,13) as $key => $value) { // tree3
                    foreach (range(1,12) as $key => $value) { // lrrh
                        foreach (range(1,11*4) as $key => $value) { //path 1
                            foreach (range(1,10*4) as $key => $value) { // path2
                                foreach (range(1,9*4) as $key => $value) { // path3
                                    $c++;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    echo $c." cycles\n";
    echo memory_get_usage()." bytes\n";
    echo (mt()-$mtStart)." secs\n";
}