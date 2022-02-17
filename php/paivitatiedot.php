<?php

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$id=isset($_POST["id"]) ? $_POST["id"] : "";
$etunimi=isset($_POST["etunimi"]) ? $_POST["etunimi"] : "";
$sukunimi=isset($_POST["sukunimi"]) ? $_POST["sukunimi"] : "";
$sahkoposti=isset($_POST["sahkoposti"]) ? $_POST["sahkoposti"] : "";
$puhelinnumero=isset($_POST["puhelinnumero"]) ? $_POST["puhelinnumero"] : "";
$pvm=isset($_POST["pvm"]) ? $_POST["pvm"] : "";
$aika=isset($_POST["aika"]) ? $_POST["aika"] : "";


if (empty($etunimi) || empty($sukunimi) || empty($sahkoposti) || empty($puhelinnumero) || empty($pvm) || empty($aika)  || empty($id)){
    header("Location:../php/tulostatiedot.php");
    exit;
}

try{
    $yhteys=mysqli_connect("db", "root", "password", "harjoitustyo");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}



$sql="update varaapoyta set etunimi=?, sukunimi=?, sahkoposti=?, puhelinnumero=?, pvm=?, aika=?, where id=?";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'ssssii', $etunimi, $sukunimi, $sahkoposti, $puhelinnumero, $pvm, $aika, $id);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);

include"./tulostatiedot.php";
?> 