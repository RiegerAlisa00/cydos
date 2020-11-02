<?php
class CallableEntry
{
    public function __invoke($x)
    {
        var_dump("__invoke wurde ausgefuehrt: {$x}");
    }
}

function test($fn) {
    $fn();
}

$entry = new CallableEntry();
$entry("test");

test($entry);
?>