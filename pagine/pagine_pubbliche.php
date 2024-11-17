<?php
session_start();
//include'pagine_di_funzionamento/register.php';
//set variables
if (isset($_GET['pag']))
 	$pag = filter_input(INPUT_GET,'pag',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
else
  	$pag = null;
if (isset($_GET['mess']))
  	$mess = filter_input(INPUT_GET,'mess',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
else
  	$mess = null;
if (isset($_GET['case']))
  	$case = filter_input(INPUT_GET,'case',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
else
  	$case = null;
if (isset($_GET['esame']))
  	$esame = filter_input(INPUT_GET,'esame',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
else
  	$esame = null;
    
include "pagine_di_funzionamento/commenti.php";
if($pag=='' && $mess=='' && $case=='' && !isset($_SESSION["id_ut"])){
	testata_pubblica($esame);
    about();
    footer();
    }
    
if($pag=='registrazione' && $mess=='' && $case=='' && !isset($_SESSION["id_ut"])){
	testata_pubblica($esame);
    register();
    footer();
    }
    
if($pag=='registrazione_avvenuta' && $mess=='' && $case=='' && !isset($_SESSION["id_ut"])){
	testata_pubblica($esame);
    echo'<p align=center><font size=5 color=006600><b>Registrazione avvenuta con successo ora puoi accedere.</b></font></p>';
    about();
    footer();
    }

if(!isset($esami))
	$esami = return_esami();
if($pag=='p' && $mess=='' && $case==''&& !isset($_SESSION["id_ut"])){
	testata_pubblica($esame);
    echo'<p><font size=6 color=006600><b>Primo anno</b></font></p>';
    while ($esame = mysql_fetch_array($esami)) {
        if($esame["anno"]=='Primo')
       		echo'<p><strong><font color="blue" size=5><a href="?pag=esame&esame='.$esame["codice"].'">'.$esame["esame"].'</a></font></strong></p>';
		}
    /*
    echo'<p><strong><font color="blue" size=5><a href="?pag=esame&esame=dirp">Diritto privato e di internet</a></font></strong></p>';
    echo'<p><strong><font color="blue" size=5><a href="?pag=esame&esame=ecoaz">Economia aziendale</a></font></strong></p>';
    echo'<p><strong><font color="blue" size=5><a href="?pag=esame&esame=micro">Microeconomia</a></font></strong></p>';
    echo'<p><strong><font color="blue" size=5><a href="?pag=esame&esame=mate">Matematica generale</a></font></strong></p>';
    echo'<p><strong><font color="blue" size=5><a href="?pag=esame&esame=fondinf">Fondamenti di informatica</a></font></strong></p>';
    echo'<p><strong><font color="blue" size=5><a href="?pag=esame&esame=prog1">Programmazione e algoritmi 1</a></font></strong></p>';
    echo'<p><strong><font color="blue" size=5><a href="?pag=esame&esame=intret">Internet e reti</a></font></strong></p>';
	*/
	footer();
    }
    
if($pag=='esame' && $mess=='' && $esame!='' && !isset($_SESSION["id_ut"])){
	testata_pubblica($esame);
	footer_esami();
    }
    
if($pag=='s' && $mess=='' && $case==''&& !isset($_SESSION["id_ut"])){
	testata_pubblica($esame);
    echo'<p><font size=6 color=006600><b>Secondo anno</b></font></p>';
    while ($esame = mysql_fetch_array($esami)) {
        if($esame["anno"]=='Secondo')
       		echo'<p><strong><font color="blue" size=5><a href="?pag=esame&esame='.$esame["codice"].'">'.$esame["esame"].'</a></font></strong></p>';
    	}
    footer();
    }
    
if($pag=='t' && $mess=='' && $case==''&& !isset($_SESSION["id_ut"])){
	testata_pubblica($esame);
    echo'<p><font size=6 color=006600><b>Terzo anno</b></font></p>';
    while ($esame = mysql_fetch_array($esami)) {
        if($esame["anno"]=='Terzo')
       		echo'<p><strong><font color="blue" size=5><a href="?pag=esame&esame='.$esame["codice"].'">Diritto privato e di internet</a></font></strong></p>';
    	}
    footer();
    }

if($pag=='recupero' && $mess=='' && $case=='' && !isset($_SESSION["id_ut"])){
	testata_pubblica($esame);
    echo'<div>';
	   	echo'<form action="/pagine_di_funzionamento/action_page.php" method="post">';
        	echo'<div class="container">';
              	echo'<label for="uname"><b><font size=5>Chiave di recupero account</font></b></label>';
              	echo'<input type="text" placeholder="Enter Key" name="key" required>';
				echo'<div>';
              		echo'<button type="submit" style="width:auto;">invia</button>';
                    echo' <input type="hidden" name="case" value="recupero">';
                echo'</div>';
          	echo'</div>';
      	echo'</form>';
		echo'</div>';   
        footer();
    }
?>