<?php
abstract class Test
{
    public function printHallo()
    {
        var_dump("Hallo");
    }
    abstract public function hallo();
}
class ExtendedTest extends Test {
    public function hallo()
    {
        
    }
}
$test = new ExtendedTest();
$test->printHallo();
?>