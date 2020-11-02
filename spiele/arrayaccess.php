<?php

class Entry implements ArrayAccess
{
    public $title = "test";
    public function offsetExists($offset)
    {
        if($offset == "content")
        {
            return true;
        }
    }
    public function offsetGet($offset)
    {
        if($offset == "content")
        {
            return $this->title;
        }
    }
    public function offsetSet($offset,$value)
    {
        if($offset == "content")
        {
             $this->title = $value;
        }
    }
    public function offsetUnset($offset)
    {
        var_dump("offsetUnset: {$offset}");
    }
}
$entry = new Entry();
$entry['content'] = "test123";
unset($entry['content']);
var_dump($entry['content']);
?>