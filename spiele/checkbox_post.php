<html>
<head>
<meta charset="utf-8" />
</head>

<body>
<form action="submit.php" method="POST">
<strong>Vorname:</strong>
<input type="text" name="firstname"/>
<br />
<strong>Nachname:</strong>
<input type="text" name="surname" />
<br/>
<strong>Tags - Elektronik:</strong>
<input type="checkbox" name="tags[]" value = "Elektronik"/>
<br/>
<strong>Tags - Obst:</strong>
<input type="checkbox" name="tags[]" value = "Obst"/>
<br/>
<strong>Tags - Programmierung:</strong>
<input type="checkbox" name="tags[]" value = "Programmierung"/>
<br/>
<input type="submit"/>
</form>
</body>
</html>