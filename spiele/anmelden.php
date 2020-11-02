<?php
$db = 'mysql:dbname=dbrieger;host=192.168.99.18;port=3306';
$username = 'rieger';
$passwort = 'rieger';
try
{
    $pdo = new PDO ($db,$username,$passwort);
}
catch (Exception $e)
{
    echo("Verbindung zur Datenbank fehlgeschlagen");
    die();
}
?>
