<?php

$id=isset($_POST["id"]) ? $_POST["id"] : "";
$etunimi=isset($_POST["etunimi"]) ? $_POST["etunimi"] : "";
$sukunimi=isset($_POST["sukunimi"]) ? $_POST["sukunimi"] : "";
$sähköposti=isset($_POST["sähköposti"]) ? $_POST["sähköposti"] : "";
$puhelinnumero=isset($_POST["puhelinnumero"]) ? $_POST["puhelinnumero"] : "";


if (empty($etunimi) || empty($sukunimi) || empty($sähköposti) || empty($puhelinnumero) || empty($id)){
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


$sql="update varaapoyta set etunimi=?, sukunimi=?, sähköposti=?, puhelinnumero=? where id=?";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'sdi', $etunimi, $sukunimi, $sähköposti, $puhelinnumero, $id);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);

header("Location:./tulostatiedot.php");
?>