<?php
session_start();
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
    
if($_SESSION["first_page"])
	$benvento = 'Ciao '.$_SESSION["username"].'!';
$_SESSION["first_page"] = false;
/*
if ($pag=='' && $caso=='' && isset($_SESSION["id_ut"]) && $_SESSION["tipo"]=='U' && $_SESSION["num_login"]!='1' && !$_SESSION["first_page"]) {
	testata_privata();
    about();
	footer();
    }*/
if ($pag=='' && $caso=='' && isset($_SESSION["id_ut"]) && $_SESSION["tipo"]=='U' && $_SESSION["num_login"]!='1' /*&& $_SESSION["first_page"]*/) {
	testata_privata($esame);
    echo'<p align=center><font size=6 color=006600><b>'.$benvento.' '.$_SESSION["string_recupero"].' </b></font></p>';
    about();
	footer();
    }
unset($_SESSION["string_recupero"]);
if ($pag=='' && $caso=='' && isset($_SESSION["id_ut"]) && $_SESSION["tipo"]=='U' && $_SESSION["num_login"]=='1') {
	testata_privata($esame);
    echo'<p align=center><font size=6 color=006600><b>'.$benvenuto.' Questo è il tuo primo acesso, ti consiglio di andare in "Account">"Chiave di recupero account". </b></font></p>';
    first_chiave_r();
    about();
	footer();
    }
    
if(!isset($esami))
	$esami = return_esami();
    
if($pag=='p' && $mess=='' && $case==''&& isset($_SESSION["id_ut"]) && $_SESSION["tipo"]=='U'){
	testata_privata();
    echo'<p align=center><font size=6 color=006600><b>'.$benvento.'</b></font></p>';
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
if($pag=='esame' && $esame!=''&& $mess=='' && $case==''&& isset($_SESSION["id_ut"]) && $_SESSION["tipo"]=='U'){
	testata_privata($esame);
    echo'<p align=center><font size=6 color=006600><b>'.$benvento.'</b></font></p>';
    footer_esami();
    }
if($pag=='s' && $mess=='' && $case==''&& isset($_SESSION["id_ut"])){
	testata_privata($esame);
    echo'<p align=center><font size=6 color=006600><b>'.$benvento.'</b></font></p>';
    echo'<p><font size=6 color=006600><b>Secondo anno</b></font></p>';
    while ($esame = mysql_fetch_array($esami)) {
        if($esame["anno"]=='Secondo')
       		echo'<p><strong><font color="blue" size=5><a href="?pag=esame&esame='.$esame["codice"].'">'.$esame["esame"].'</a></font></strong></p>';
		}
    footer();
    }
if($pag=='t' && $mess=='' && $case==''&& isset($_SESSION["id_ut"]) && $_SESSION["tipo"]=='U'){
	testata_privata($esame);
    echo'<p align=center><font size=6 color=006600><b>'.$benvento.'</b></font></p>';
    echo'<p><font size=6 color=006600><b>Terzo anno</b></font></p>';
    while ($esame = mysql_fetch_array($esami)) {
        if($esame["anno"]=='Terzo')
       		echo'<p><strong><font color="blue" size=5><a href="?pag=esame&esame='.$esame["codice"].'">'.$esame["esame"].'</a></font></strong></p>';
		}
    footer();
    }
if($mess=='segn' && $case=='' && isset($_SESSION["id_ut"])){
	testata_privata($esame);
    //fare segnalazione dando come campo precompilato il valore di pag per indentificare l'esame in questione
    footer();
    }
if($pag=='account' && $mess=='' && $case=='' && isset($_SESSION["id_ut"]) && $_SESSION["tipo"]=='U'){
	testata_privata($esame);
    echo'<p align=center><font size=5 color=006600><b>'.$_SESSION["cambio"].'</b></font></p>';
	unset($_SESSION["cambio"]);
    echo'<p><font size=6 color=006600><b>Account</b></font></p>';

	echo'<p><font size=5 color=006600><b>Chiave di recupero account</b></font></p>';
    echo'<p><font size=5 >La chiave di recupero account è una stringa random salvata criptata nel database, va utilizzata nel caso in cui tu abbia dimenticato username e/o password del tuo account. Si usa questo metodo perché ho deciso di non raccogliere le e-mail degli utenti.</font></p>';
    echo'<p><font size=5 >È tua responsabilità copiarla e salvarla in modo da poterla utilizzare in futuro, clicca genera se non hai una chiave di recupero account.</font></p>';
    if (isset($_SESSION["chiave_r"]))
    	echo'<p><font size=5 color=006600><b> La chiave di recupero account è: '.$_SESSION["chiave_r"].'</b></font></p>';
	else
        echo'<p><font size=5 ><a href="/pagine_di_funzionamento/action_page.php?pag=genera">Genera</a></font></p>';
    
    echo'<p><font size=5 color=006600><b>Username</b></font></p>';
    echo'<div>';
        echo'<form action="/pagine_di_funzionamento/action_page.php?pag=account" method="post">';
            echo'<div class="container">';
            echo'<input type="text" value="'.$_SESSION["username"].'" name="username" maxlength="30" required >';
            echo'<div>';
                echo'<button type="submit" style="width:auto;">Cambia</button>';
                echo '<input type="hidden" name="case" value="cambio_username">'."\n";                    
            echo'</div>';
            echo'</div>';
        echo'</form>';
    echo'</div>';
    
   	echo'<p><font size=5 color=006600><b>Cambia password</b></font></p>';
	echo'<div>';
	   	echo'<form action="/pagine_di_funzionamento/action_page.php?pag=account" method="post">';
        	echo'<div class="container">';
                
              	echo'<label for="psw"><b>Password</b></label>';
              	echo'<input type="password" placeholder="Enter Password" name="psw" required>';
                
                echo'<label for="cpsw"><b>Conferma password</b></label>';
              	echo'<input type="password" placeholder="Enter Password" name="cpsw" required>';
                
				echo'<div>';
              		echo'<button type="submit" style="width:auto;">Cambia</button>';
                	echo '<input type="hidden" name="case" value="cambio_password">'."\n";                    
                echo'</div>';

          	echo'</div>';

      	echo'</form>';
		echo'</div>';

    footer();
    }
?>