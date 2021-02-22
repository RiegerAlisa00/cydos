<?php
$db = 'mysql:dbname=dbrieger;host=192.168.99.18;port=3306;charset=utf8;';
$username = 'rieger';
$passwort = 'rieger';
$pdo = new PDO($db, $username, $passwort);
$myarray = $_POST;
switch ($myarray['ablauf']) {
    case 'neu':
    case 'bearbeiten2':
        foreach ($myarray as $key => $value) {
            if ($value == '') {
                $myarray[$key] = null;
            }
        }
        $erg = true;
        $detail = '';
        if ($erg) {
            if ($myarray['customerNumber'] == '') {
                $detail = 'Das Feld customerNumber darf nicht leer sein';
                $erg = false;
            }
            if ($myarray['customerName'] == '') {
                $detail = 'Das Feld customerName darf nicht leer sein';
                $erg = false;
            }
            if ($myarray['contactLastName'] == '') {
                $detail = 'Das Feld contactLastName darf nicht leer sein';
                $erg = false;
            }
            if ($myarray['contactFirstName'] == '') {
                $detail = 'Das Feld contactFirstName darf nicht leer sein';
                $erg = false;
            }
            if ($myarray['phone'] == '') {
                $detail = 'Das Feld phone darf nicht leer sein';
                $erg = false;
            }
            if ($myarray['addressLine1'] == '') {
                $detail = 'Das Feld addressLine1 darf nicht leer sein';
                $erg = false;
            }
            if ($myarray['city'] == '') {
                $detail = 'Das Feld  darf nicht leer sein';
                $erg = false;
            }
            if ($myarray['country'] == '') {
                $detail = 'Das Feld city darf nicht leer sein';
                $erg = false;
            }
        }
        if ($erg) {
            if (!is_numeric($myarray['customerNumber'])){
                $detail = 'In dem Feld customerNumber darf nur Zahlen drinnen stehen';
                $erg = false;
            } 
            if (!is_numeric($myarray['salesRepEmployeeNumber'])){
                if (!is_null($myarray['salesRepEmployeeNumber'])) {
                    $detail = 'In dem Feld salesRepEmployeeNumber darf nur Zahlen drinnen stehen';
                    $erg = false;
                }
            } 
            if (!is_numeric($myarray['creditLimit'])) {
                if (!is_null($myarray['creditLimit'])) {
                    $detail = 'In dem Feld creditLimit darf nur Zahlen drinnen stehen';
                    $erg = false;
                } 
            }
        }
        if ($erg) {
            if (strlen($myarray['customerNumber']) > 11){
                $detail = 'In dem Feld customerNumber darf die Zahl max 11 Zeichen lang sein';
                $erg = false;
            }
            if (strlen($myarray['salesRepEmployeeNumber']) > 11) {
                $detail = 'In dem Feld salesRepEmployeeNumber darf die Zahl max 11 Zeichen lang sein';
                $erg = false;
            }
        }
        if ($erg) {
            if (strlen($myarray['creditLimit']) > 10) {
                $detail = 'In dem Feld creditLimit darf die Zahl max 10 Zeichen lang sein';
                $erg = false;
            }
        }
        if ($erg) {
            if (strlen($myarray['customerName']) > 50){
                $detail = 'In dem Feld customerName darf der Inhalt nur max 50 Zeichen lang sein';
                $erg = false;
            }
            if (strlen($myarray['contactLastName']) > 50){
                $detail = 'In dem Feld contactLastName darf der Inhalt nur max 50 Zeichen lang sein';
                $erg = false;
            }
            if (strlen($myarray['contactFirstName']) > 50){
                $detail = 'In dem Feld contactFirstName darf der Inhalt nur max 50 Zeichen lang sein';
                $erg = false;
            }
            if (strlen($myarray['phone']) > 50){
                $detail = 'In dem Feld phone darf der Inhalt nur max 50 Zeichen lang sein';
                $erg = false;
            }
            if (strlen($myarray['addressLine1']) > 50){
                $detail = 'In dem Feld addressLine1 darf der Inhalt nur max 50 Zeichen lang sein';
                $erg = false;
            }
            if (strlen($myarray['addressLine2']) > 50){
                $detail = 'In dem Feld addressLine2 darf der Inhalt nur max 50 Zeichen lang sein';
                $erg = false;
            }
            if (strlen($myarray['city']) > 50){
                $detail = 'In dem Feld city darf der Inhalt nur max 50 Zeichen lang sein';
                $erg = false;
            }
            if (strlen($myarray['state']) > 50){
                $detail = 'In dem Feld state darf der Inhalt nur max 50 Zeichen lang sein';
                $erg = false;
            }
            if (strlen($myarray['country']) > 50) {
                $detail = 'In dem Feld country darf der Inhalt nur max 50 Zeichen lang sein';
                $erg = false;
            }
        }
        if ($erg) {
            if (strlen($myarray['postalCode']) > 15) {
                $detail = 'In dem Feld postalCode darf der Inhalt nur max 15 Zeichen lang sein';
                $erg = false;
            }
        }
        if ($myarray['ablauf'] == 'neu') {
            if ($erg) {
                $sql = "SELECT * from customers where customerNumber = :customerNumber";
                $stmt = $pdo->prepare($sql, array(
                    $pdo::ATTR_CURSOR => $pdo::CURSOR_SCROLL
                ));
                $stmt->execute(array(
                    ':customerNumber' => $myarray['customerNumber']
                ));
                $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
                if ($row) {
                    $erg = false;
                    $detail = 'customerNumber ist schon vorhanden';
                }
            }
            if ($erg) {
                $sql = 'INSERT INTO customers (customerNumber,customerName,contactLastName,contactFirstName,phone,addressLine1,addressLine2,city,state,postalCode,country,salesRepEmployeeNumber,creditLimit) VALUES (:customerNumber,:customerName,:contactLastName,:contactFirstName,:phone,:addressLine1,:addressLine2,:city,:state,:postalCode,:country,:salesRepEmployeeNumber,:creditLimit);';
                $pdo->beginTransaction();
                $sth = $pdo->prepare($sql);
                $sth->execute(array(
                    ':customerNumber' => $myarray['customerNumber'],
                    ':customerName' => $myarray['customerName'],
                    ':contactLastName' => $myarray['contactLastName'],
                    ':contactFirstName' => $myarray['contactFirstName'],
                    ':phone' => $myarray['phone'],
                    ':addressLine1' => $myarray['addressLine1'],
                    ':addressLine2' => $myarray['addressLine2'],
                    ':city' => $myarray['city'],
                    ':state' => $myarray['state'],
                    ':postalCode' => $myarray['postalCode'],
                    ':country' => $myarray['country'],
                    ':salesRepEmployeeNumber' => $myarray['salesRepEmployeeNumber'],
                    ':creditLimit' => $myarray['creditLimit']
                ));
                $pdo->commit();
            }
        } else {
            if ($erg) {
                if ($myarray['customerNumber'] == $myarray['cn']) {
                    $erg = true;
                    $detail = '';
                } else {
                    $sql = "SELECT * from customers where customerNumber = :customerNumber";
                    $stmt = $pdo->prepare($sql, array(
                        $pdo::ATTR_CURSOR => $pdo::CURSOR_SCROLL
                    ));
                    $stmt->execute(array(
                        ':customerNumber' => $myarray['customerNumber']
                    ));
                    $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
                    if ($row) {
                        $erg = false;
                        $detail = 'customerNumber ist schon vorhanden';
                    }
                }
            }
            if ($erg) {
                $sql_update = 'UPDATE customers SET customerNumber = :customerNumber, customerName = :customerName, contactLastName = :contactLastName, contactFirstName = :contactFirstName, phone = :phone, addressLine1 = :addressLine1,addressLine2 = :addressLine2,city = :city,state = :state,postalCode = :postalCode,country = :country,salesRepEmployeeNumber = :salesRepEmployeeNumber,creditLimit = :creditLimit WHERE customerNumber = :cn;';
                $pdo->beginTransaction();
                $sth = $pdo->prepare($sql_update);
                $sth->execute(array(
                    ':customerNumber' => $myarray['customerNumber'],
                    ':customerName' => $myarray['customerName'],
                    ':contactLastName' => $myarray['contactLastName'],
                    ':contactFirstName' => $myarray['contactFirstName'],
                    ':phone' => $myarray['phone'],
                    ':addressLine1' => $myarray['addressLine1'],
                    ':addressLine2' => $myarray['addressLine2'],
                    ':city' => $myarray['city'],
                    ':state' => $myarray['state'],
                    ':postalCode' => $myarray['postalCode'],
                    ':country' => $myarray['country'],
                    ':salesRepEmployeeNumber' => $myarray['salesRepEmployeeNumber'],
                    ':creditLimit' => $myarray['creditLimit'],
                    ':cn' => $myarray['cn']
                ));
                $pdo->commit();
            }
        }
        break;
    case 'del':
        $sql = 'DELETE FROM customers WHERE customerNumber = :customerNumber;';
        $pdo->beginTransaction();
        $sth = $pdo->prepare($sql);
        $sth->execute(array(
            ':customerNumber' => $myarray['customerNumber']
        ));
        $pdo->commit();
        break;
    case 'bearbeiten1':
        $sql = "SELECT * FROM customers where customerNumber = :customerNumber";
        $stmt = $pdo->prepare($sql, array(
            $pdo::ATTR_CURSOR => $pdo::CURSOR_SCROLL
        ));
        $stmt->execute(array(
            ':customerNumber' => $myarray['customerNumber']
        ));
        $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $detail = $row;
        $erg = true;
        break;
    case 'alles':
        $sql = "SELECT * FROM customers";
        $fullarray = array();
        $stmt = $pdo->prepare($sql, array(
            $pdo::ATTR_CURSOR => $pdo::CURSOR_SCROLL
        ));
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $fullarray[] = $row;
        }
        $detail = $fullarray;
        $erg = true;
        break;
}
header("Content-type: application/json");
echo json_encode(array(
    'erg' => ($erg ? 'OK' : 'NOK'),
    'detail' => $detail
));
?>