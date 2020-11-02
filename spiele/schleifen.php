<?php
$summe = 0;
for ($i = 0; $i<=100;$i++){
    $summe += $i;
    var_dump($summe);
}
echo strtoupper($summe);
?>

<br/>
<br/>
<?php
$summe = 0;
$i = 0;
while ($i<=100) {
    $summe += $i;
    var_dump($summe);
    $i++;   
}
echo strtoupper($summe);
error_log($summe);
?>