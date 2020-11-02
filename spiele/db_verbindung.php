<?php
$db = 'mysql:dbname=dbrieger;host=192.168.99.18;port=3306';
$username = 'rieger';
$passwort = 'rieger';
$pdo = new PDO ($db,$username,$passwort);
$sql = "SELECT * FROM posts";
$res = $pdo->query($sql);
$select = $res->fetch();
echo ($select[0])."<br/>".($select[1])."<br/>"."<br/>";
foreach ($select AS $row){
    echo ($row)."<br/>";
}
//var_dump($_GET);
?>