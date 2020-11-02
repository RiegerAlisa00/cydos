<?php
class Test
{
    public $name = "Welt";
}
$t = new Test();

$a = [
    "schluessel"=>"Hallo Welt",
    $t
];
echo '<h2>serialize</h2>';
echo serialize($a);
$str = serialize($a);
echo '<br/>';
echo '<h2>unserialize</h2>';
$a = unserialize($str);
var_dump($a);
?>