<?php

class Entry
{
    public $title;
    public function __construct($title) {
        $this->title = $title;
    }
}
$saetze = [
    14 => new Entry("Obst"),
    44 => new Entry("Kaese"),
    11 => new Entry("Milch")
];

usort($saetze, function ($a,$b) {
    return strcmp($a->title, $b->title);
});
var_dump($saetze);
?>