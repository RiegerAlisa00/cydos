<?php
$a = array('ablauf'=>'e','leer'=>'');
switch (true) {
    case !is_numeric($a['ablauf']):
        echo '+';
        switch ('') {
            case $a['leer']:
            echo 'leer';
            break;
        }
        break;
    case 'e':
        echo 'e';
        break;
    case 'b':
        echo 'b';
        break;
    case 'c':
        echo 'c';
        break;
}

?>