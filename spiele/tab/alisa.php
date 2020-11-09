<?php
$db = 'mysql:dbname=dbrieger;host=192.168.99.18;port=3306;charset=utf8;';
$username = 'rieger';
$passwort = 'rieger';
$pdo = new PDO ($db,$username,$passwort);
$sql = "SELECT * FROM customers";

$fullarray = array();
$stmt = $pdo->prepare($sql, array($pdo::ATTR_CURSOR => $pdo::CURSOR_SCROLL));
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
    $fullarray[] = $row;
}

header("Content-type: application/json");
echo json_encode($fullarray);
?>