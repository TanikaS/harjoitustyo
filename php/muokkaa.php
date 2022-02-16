<?php

$muokattava=isset($_GET["muokattava"]) ? $_GET["muokattava"] : "";

//Jos tietoa ei ole annettu, palataan listaukseen
if (empty($muokattava)){
    header("Location:./tulostatiedot.php");
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("db", "root", "password", "harjoitustyo");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}

$sql="select * from varaapoyta where id=?";
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttuja sql-lauseeseen
mysqli_stmt_bind_param($stmt, 'i', $muokattava);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Koska luetaan prepared statementilla, tulos haetaan
//metodilla mysqli_stmt_get_result($stmt);
$tulos=mysqli_stmt_get_result($stmt);
if (!$rivi=mysqli_fetch_object($tulos)){
    header("Location:../html/tietuettaeiloydy.html");
    exit;
}
?>



<form action='./paivitatiedot.php' method='post'>
<input type='hidden' name='id' value='<?php print $rivi->id;?>' readonly><br>
Etunimi:<input type='text' name='nimi' value='<?php print $rivi->etunimi;?>'><br>
Sukunimi:<input type='text' name='sukunimi' value='<?php print $rivi->sukunimi;?>'><br>
Sähköposti:<input type='text' name='sähköposti' value='<?php print $rivi->sähköposti;?>'><br>
Puhelinnumero:<input type='text' name='puhelinnumero' value='<?php print $rivi->puhelinumero;?>'><br>
<input type='submit' name='ok' value='ok'><br>
</form>

<!-- loppuun uusi php-osuus -->
<?php
//Suljetaan tietokantayhteys
mysqli_close($yhteys);
?>