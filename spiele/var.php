<?php
class Entry
{
    public $title = "Hallo Welt";
    public function testMethod() {
        var_dump("testMethod() wurde ausgefuehrt");
    }
}
$entry = new Entry();
$name = "testMethod";
$entry->$name();
?>