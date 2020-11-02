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
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Titel der Seite | Name der Website</title>
  </head>
  <body>
    <?php
?>
<h1 style = "text-align:center;">HTML mit PHP</h1>
<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut 
labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et 
ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem 
ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et 
dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. 
Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor 
sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore 
magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet 
clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p> 

<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum 
dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent 
luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, 
consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam 
erat volutpat. </p>
<?php

$sql = "SELECT * FROM posts";
$res = $pdo->query($sql);
?>

<ul>
<?php 
foreach ($res AS $row)
{
    echo "<li>{$row["title"]}</li>";
    echo "<ul><li>{$row["content"]}</li></ul>";
}
?>
</ul>
  </body>
</html>