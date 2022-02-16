<?php

$id=isset($_POST["id"]) ? $_POST["id"] : "";
$etunimi=isset($_POST["etunimi"]) ? $_POST["etunimi"] : "";
$sukunimi=isset($_POST["sukunimi"]) ? $_POST["sukunimi"] : "";
$s�hk�posti=isset($_POST["s�hk�posti"]) ? $_POST["s�hk�posti"] : "";
$puhelinnumero=isset($_POST["puhelinnumero"]) ? $_POST["puhelinnumero"] : "";


if (empty($etunimi) || empty($sukunimi) || empty($s�hk�posti) || empty($puhelinnumero) || empty($id)){
    header("Location:../html/tietuettaeiloydy.html");
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


try{
    $yhteys=mysqli_connect("db", "root", "password", "harjoitustyo");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}


$sql="update varaapoyta set etunimi=?, sukunimi=?, s�hk�posti=?, puhelinnumero=? where id=?";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'sdi', $etunimi, $sukunimi, $s�hk�posti, $puhelinnumero, $id);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);

header("Location:./tulostatiedot.php");
?>