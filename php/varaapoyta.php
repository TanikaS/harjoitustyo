<?php

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$etunimi=isset($_POST["etunimi"]) ? $_POST["etunimi"] : "";
$sukunimi=isset($_POST["sukunimi"]) ? $_POST["sukunimi"] : "";
$sahkoposti=isset($_POST["sahkoposti"]) ? $_POST["sahkoposti"] : "";
$puhelinnumero=isset($_POST["puhelinnumero"]) ? $_POST["puhelinnumero"] : "";
$pvm=isset($_POST["pvm"]) ? $_POST["pvm"] : "";
$aika=isset($_POST["aika"]) ? $_POST["aika"] : "";


if (empty($etunimi) || empty($sukunimi) || empty($sahkoposti) || empty($puhelinnumero) || empty($pvm) || empty($aika)){
    header("Location:../html/varaapoyta.html");
    exit;
}

try{
    $yhteys=mysqli_connect("db", "root", "password", "harjoitustyo");
}

 catch(Exception $e){
  header("Location:../html/yhteysvirhe.html");
    exit;
 }


$sql="insert into varaapoyta (etunimi, sukunimi, sahkoposti, puhelinnumero, pvm, aika) values(?, ?, ?, ?, ?, ?)";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'sssssi', $etunimi, $sukunimi, $sahkoposti, $puhelinnumero, $pvm, $aika);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);

header("Location:./tulostatiedot.php"); 
?>
