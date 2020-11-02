<?php
$time = time() % 600;
class Player{
    var $time;
    function Player(){
        global $time;
        $this->time = $time;
    }
}
class QB extends Player{
    function starts() {
        $yards = floor($this->time/30)*10;
        $tds = floor($this->time/240);
        return array(
            "yards" => $yards,
            "TD" => $tds,
            "points" => floor($yards/25)+(4*$tds),
            "summary" => $yards."yardss passing, ".$tds." TD"
        );
    }
}
?>