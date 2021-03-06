<?php
session_start();
if (!isset($_SESSION["kayttaja"])){
    header("Location:../html/kirjaudu.html");
    exit;
}
print "<h2>Tervetuloa, ".$_SESSION["kayttaja"]."!</h2>";
?>
<a href='kirjauduulos.php'>Kirjaudu ulos</a>

<?php

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
$initials=parse_ini_file("../.ht.asetukset.ini");
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
    $yhteys=mysqli_connect($initials["databaseserver"], $initials["username"], $initials["password"], $initials["database"]);
}

 catch(Exception $e){
  header("Location:../html/yhteysvirhe.html");
    exit;
 }


$sql="insert into varaapoyta (etunimi, sukunimi, sahkoposti, puhelinnumero, pvm, aika) values(?, ?, ?, ?, ?, ?)";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'ssssss', $etunimi, $sukunimi, $sahkoposti, $puhelinnumero, $pvm, $aika);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);

header("Location:./tulostatiedot.php"); 
?>
