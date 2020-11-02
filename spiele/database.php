<?php
$db = 'mysql:dbname=dbrieger;host=192.168.99.18;port=3306';
$username = 'rieger';
$passwort = 'rieger';
$pdo = new PDO ($db,$username,$passwort);

$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

function fetch_posts() {
    global $pdo;
    return $pdo->query("SELECT * FROM posts");
}

function fetch_post($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}
?>