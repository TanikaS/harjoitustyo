

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='../css/menupage.css'>
    <title>SITKO - MENU</title>
</head>
    <body class="all">
        <header>
            <a href="index.html" target="_blank"> <img src="../images/logo.jpg" class="img1" alt=logo ></a>
        </header>
    
        <div class="all-body">
    
            <section class="all-content">
      <div>

<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("db", "root", "password", "harjoitustyo");
}
catch(Exception $e){
    print "Yhteysongelma";
    print "<a href='../html/varaapoyta.html'>Takaisin lomakkeeseen</a>";
    include "../html/footer.html";
    exit;
}
$tulos=mysqli_query($yhteys, "select * from varaapoyta");

while ($rivi=mysqli_fetch_object($tulos)){
    print "<p>$rivi->etunimi <br> $rivi->sukunimi <br> $rivi->sahkoposti <br> $rivi->puhelinnumero <br> $rivi->pvm <br> $rivi->aika <br>". " <a href='./muokkaa.php?muokattava=$rivi->id'> Muokkaa</a>
                                                                                                                                              <a href='./poista.php?poistettava=$rivi->id'> Poista</a> ";
}

mysqli_close($yhteys);
?>



     
    </div>
    
            </section>
    
            <div class="all-sidebar-1 all-sidebar">
                <ul>
                    <li><a href="index.html">ETUSIVU</a></li>
                    <li><a href="menupage.html">MENU</a></li>
                    <li><a href="varaapoyta.html">VARAA PÖYTÄ</a></li>
                  </ul>
            </div>
    
            <div class="all-sidebar-2 all-sidebar">
                <h4>SITKO PIZZA
                    TAMPERE </h4>
                   <address> Näsilinnankatu 22 <br>
                    33210 Tampere </address> <br> 
                
                    <h4>AUKIOLO</h4>    
                    <p>MA-TO 12–20 <br>
                    PE 11–21<br>
                    LA 12–21<br>
                    SU 13–20 </p> <br>               

                    <h4>YHTEYSTIEDOT</h4>
                    <address>
                   +358 40 550 6499 <br>
                   sitko@ravintolasitko.fi </address>
                
            </div>
    
        </div>
    
        <footer>
            <h3>SEURAA MEITÄ</h3>
            
            <a href="https://www.instagram.com/sitkopizza/?hl=en" target="_blank"><img src="https://sitko.pizza/wp-content/uploads/2021/12/instagram-1.svg"  class="img2" alt="ig"> </a>
            <a href="https://www.facebook.com/sitkopizza/" target="_blank"><img src="https://sitko.pizza/wp-content/uploads/2021/12/facebook-1.svg"  class="img2" alt="fb"></a>
       
        </footer>
   

</body>
</html>