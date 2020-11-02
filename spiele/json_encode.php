<?php
$data = array(
    "QB"=> "Alexander Hamilton",
    "RB" => "John Jay",
    "WR" => "James Madison"
);
echo json_encode($data);

$teams = array(
    "team1" => array(
        "QB"=> "Alexander Hamilton",
        "RB" => "John Jay",
        "WR" => "James Madison"
    ),
    "team2" => array(
        "QB"=> "George Washingron",
        "RB" => "John Adams",
        "WR" => "John Hancock"
    )
);
echo json_encode($teams)
?>