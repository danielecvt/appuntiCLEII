<?php
if(!function_exists('testata_pubblica'))
	include "testata_footer.php";
include 'mysql_fix.php';
session_start();

if (isset($_GET['pag']))
 	$pag = filter_input(INPUT_GET,'pag',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
else
  	$pag = null;
if (isset($_POST['case']))
  	$case = filter_input(INPUT_POST,'case',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
else
  	$case = null;
if (isset($_GET['esame']))
  	$esame = filter_input(INPUT_GET,'esame',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
else
  	$esame = null;
if (isset($_GET['pdf']))
  	$pdf = filter_input(INPUT_GET,'pdf',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
else
  	$pdf = null;
if (isset($_GET['richiesta']))
  	$richiesta = filter_input(INPUT_GET,'richiesta',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
else
  	$richiesta = null;
if (isset($_GET['codice']))
  	$codice = filter_input(INPUT_GET,'codice',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
else
  	$codice = null;

$conn = mysql_connect("localhost","root","") or die("errore di connessione");
$db = mysql_select_db("my_appunticleii") or die("errore di selezione del database");

function return_esami(){
	$q = "select * from esami";
    $rq = mysql_query($q);
    return $rq;
}

function rand_chiave_r(){
	$chiave_r='';
	for($i=15;$i>0;$i--){
		$chiave_r.=chr(rand(97,122));
        $chiave_r.=chr(rand(33,47));
        }
	return $chiave_r;
 	}
    
function first_chiave_r(){
	$_SESSION["chiave_r"] = rand_chiave_r();
    $conn = mysql_connect("localhost","root","") or die("errore di connessione");
	$db = mysql_select_db("my_appunticleii") or die("errore di selezione del database");
    $query='UPDATE `utenti` SET `chiave_r` = '.'"'.password_hash($_SESSION["chiave_r"], PASSWORD_DEFAULT).'"'.' WHERE `utenti`.`id_ut` = '.$_SESSION["id_ut"].';';
    $rquery = mysql_query($query) or die("errore con il salvataggio dell\'utente 
             ".$query."<br>".mysql_error());
    } 
    
if($case=='registrazione' && $pag==''&& $mess=='' &&  !isset($_SESSION["id_ut"])){
	$q = "select * from utenti where username='".$_POST["uname"]."'";
	$rq = mysql_query($q) or die("ee1");
	$num = mysql_num_rows($rq);
    if ($num==0) {
        if($_POST["psw"] ==$_POST["cpsw"]){
             $_SESSION["chiave_r"] = rand_chiave_r();
             $query = "INSERT INTO `utenti` 
             (`username`, `password`, `data_reg`, `tipo`, `chiave_r`, `num_segnalazioni`, `num_richieste`, `num_commenti`, `num_login`)
             values (";
             $query.= "'".mysql_real_escape_string($_POST["uname"])."',";
             $query.= "'".password_hash($_POST["psw"], PASSWORD_DEFAULT)."',";
             $query.= "'".date("Y/m/d h/i/s")."',";
             $query.= "'"."U"."',";
             $query.= "'".password_hash($_SESSION["chiave_r"], PASSWORD_DEFAULT)."',";
			 $query.= '0'.",";
             $query.= '0'.",";
             $query.= '0'.",";
             $query.= '0'.")";
             
             $risultato = mysql_query($query) or die("errore con il salvataggio dell\'utente 
             ".$query."<br>".mysql_error());
             header('Location: https://appunticleii.altervista.org/?pag=registrazione_avvenuta');
             exit(); 
        }
        else{
            testata_pubblica();
            echo'<p align=center><font size=5 color=006600><b>Le password non sono uguali <a href="https://appunticleii.altervista.org/?pag=registrazione"><u><font color="blue">riprova</font></u></a>.</b></font></p>';
            footer();
        }
        }
    else{
        testata_pubblica();
        echo'<p align=center><font size=5 color=006600><b>Questo username è stato già usato <a href="https://appunticleii.altervista.org/?pag=registrazione"><u><font color="blue">riprova</font></u></a> con uno diverso.</b></font></p>';
        footer();
        }
	}
    
if ($richiesta=="true" && $pag!=="" && $esame!=="" &&  isset($_SESSION["id_ut"])) {
	
	$q = "select `id_esame`,`num_richieste` from `esami` where `codice`='".$esame."'";
    $rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
                                           ".$q."<br>".mysql_error());
    $qesame = mysql_fetch_assoc($rq);
    
    $q = "select id_richiesta from richiede where fk_id_ut='".$_SESSION["id_ut"]."' and fk_id_esame='".$qesame["id_esame"]."'";
    $rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
                                                 ".$q."<br>".mysql_error());
    $richiesta = mysql_num_rows($rq);//this can be 0 or 1

	if($richiesta){
    header("Location: https://appunticleii.altervista.org?pag=".$pag.'&esame='.$esame);
    exit();
    }
   	//echo $esame;
    
    $query = "INSERT INTO `richiede` 
                   (`fk_id_ut`, `fk_id_esame`, `data`)
                   values (";
    $query.= "'".mysql_real_escape_string($_SESSION["id_ut"])."',";
    $query.= "'".mysql_real_escape_string($qesame["id_esame"])."',";
    $query.= "'".date("Y/m/d h/i/s")."')";
    $risultato = mysql_query($query) or die("errore con il salvataggio dell\'utente 
                                                 ".$query."<br>".mysql_error());
    $num = $qesame["num_richieste"] + 1;
    $q = "UPDATE `esami` SET `num_richieste` = '".$num."' WHERE `esami`.`id_esame` = '".$qesame["id_esame"]."';";
    $rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
                                           ".$q."<br>".mysql_error());
                                           
    $q = "select num_richieste from utenti where utenti.id_ut='".$_SESSION["id_ut"]."'";
    $rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
                                           ".$q."<br>".mysql_error());
    $num_richieste = mysql_fetch_assoc($rq);
    $num_richieste["num_richieste"] += 1;
    $q = "UPDATE `utenti` SET `num_richieste` = '".$num_richieste["num_richieste"]."' WHERE `utenti`.`id_ut` = '".$_SESSION["id_ut"]."';";
    $rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
                                           ".$q."<br>".mysql_error());
                                           
    $_SESSION["richiesta"] = true;
    header("Location: https://appunticleii.altervista.org?pag=".$pag.'&esame='.$esame);
    exit();
	}
function login_session($utente){
	$_SESSION["id_ut"] = $utente["id_ut"];
    $_SESSION["username"] = $utente["username"];
    $_SESSION["data_reg"] = $utente["data_reg"];
    $_SESSION["tipo"] = $utente["tipo"];
    $_SESSION["first_page"] = true;
    $_SESSION["num_login"] = intval($utente["num_login"]) + 1;
    $q='UPDATE `utenti` SET `num_login` = '.$_SESSION["num_login"].' WHERE `utenti`.`id_ut` = '.$utente["id_ut"].';';
    $rq = mysql_query($q) or die(" con il salvataggio dell\'utente 
             ".$q."<br>".mysql_error());
    $query='UPDATE `utenti` SET `data_ult_acc` = '."'".date("Y-m-d H:i:s")."'".' WHERE `utenti`.`id_ut` = '.$_SESSION["id_ut"].';';
    $rquery = mysql_query($query) or die("errore con il salvataggio dell\'utente 
              ".$query."<br>".mysql_error());
	}

function header_call($pag,$esame){
	if($pag==''){
        header("Location: https://appunticleii.altervista.org");           
        exit();
      	}else{
        	if($esame==''){
                header("Location: https://appunticleii.altervista.org?pag=".$pag);
                exit();
                }else{
                    header("Location: https://appunticleii.altervista.org?pag=".$pag.'&esame='.$esame); 
                    exit();
                    }
           	}
	}

if((preg_match("/login/i",$case) or isset($_COOKIE['username'])) && !isset($_SESSION["id_ut"])){
    $q = "select * from utenti where username='".$_POST["uname"]."' or username ='".$_COOKIE["username"]."'";
    $rq = mysql_query($q) or die(" con il salvataggio dell\'utente 
             ".$q."<br>".mysql_error());
    $num = mysql_num_rows($rq); //this can be 0 or 1
    $utente = mysql_fetch_assoc($rq);
    
    if(isset($_COOKIE["username"])){
        	login_session($utente);
            header_call($pag,$esame);
            }
    
    if ($num) {
        //utente esiste        
        if (password_verify($_POST["psw"],$utente["password"])) {
    		//password corretta
            if($_POST["connesso"]=="on")
            	setcookie("username",  $_POST["uname"], time()+(100*365*24*60*60),'/',"appunticleii.altervista.org");
            
            login_session($utente);
            header_call($pag,$esame);
                    
            }
		    else {
                //password errata
                testata_pubblica($esame);
        		echo'<p align=center><font size=5 color=006600><b>Password errata riprova.</b></font></p>';
                footer();
                }
        }
        else {
          //username inesistente
          testata_pubblica();
          echo'<p align=center><font size=5 color=006600><b>Utente inesistente riprova.</b></font></p>';
          footer();
        }
 
	}

if ($pag=="logout" &&  $mess=='' && $case=='' && isset($_SESSION["id_ut"])) {
    $query='UPDATE `utenti` SET `data_ult_acc` = '."'".date("Y/m/d h/i/s")."'".' WHERE `utenti`.`id_ut` = '.$_SESSION["id_ut"].';';
    $rquery = mysql_query($query) or die("errore con il salvataggio dell\'utente 
             ".$query."<br>".mysql_error());
    
    if(isset($_COOKIE['username'])){
    	unset($_COOKIE['username']);
        setcookie("username","",time()-3600,'/',"appunticleii.altervista.org");
    	}
    session_unset();
    session_destroy();
    header("Location: https://appunticleii.altervista.org");
    exit();
    }
    
if ($pag=="genera" &&  $mess=='' && $case=='' && isset($_SESSION["id_ut"])){
	$_SESSION["chiave_r"] = rand_chiave_r();
	$query='UPDATE `utenti` SET `chiave_r` = '.'"'.password_hash($_SESSION["chiave_r"], PASSWORD_DEFAULT).'"'.' WHERE `utenti`.`id_ut` = '.$_SESSION["id_ut"].';';
    $rquery = mysql_query($query) or die("errore con il salvataggio dell\'utente 
             ".$query."<br>".mysql_error());
    header("Location: https://appunticleii.altervista.org?pag=account");
    exit();
	}
    
if ($case=='recupero' && $pag=="" &&  $mess=='' && !isset($_SESSION["id_ut"])){
    $quer = "select * from utenti";
    $rquer = mysql_query($quer) or die("errore con il salvataggio dell\'utente 
             ".$quer."<br>".mysql_error());
    while ($row = mysql_fetch_array($rquer, MYSQL_NUM)) {
        if(password_verify($_POST["key"],$row[5]))
        	$utente = $row;
    }    
    
    if (isset($utente)) {
        //utente esiste
        $_SESSION["id_ut"] = $utente[0];
        $_SESSION["username"] = $utente[1];
        $_SESSION["data_reg"] = $utente[3];
        $_SESSION["tipo"] = $utente[4];
        $_SESSION["first_page"] = true;
        $num =  intval($utente[9]) + 1;
        $_SESSION["num_login"] = $num;
        $q='UPDATE `utenti` SET `num_login` = '.$num.' WHERE `utenti`.`id_ut` = '.$utente[0].';';
        $rq = mysql_query($q) or die("ee1");
        $_SESSION["string_recupero"] = 'Ora cambia la password e/o guarda l\'username da "Account".';
        header("Location: https://appunticleii.altervista.org");
        }
    else{
    	testata_pubblica();
          	echo'<p align=center><font size=5 color=006600><b>Chiave di recupero errata, riprova o crea un nuovo account.</b></font></p>';
        footer();
     	}
	}
    
if($case=='reg_esame' && $pag==''&& $mess=='' &&  isset($_SESSION["id_ut"]) && $_SESSION["tipo"]=='A'){
    $q = "select * from esami where codice='".$_POST["codice"]."'";
	$rq = mysql_query($q) or die("ee1");
	$num = mysql_num_rows($rq);
    if ($num==0) {
    	$query = "INSERT INTO `esami` 
             (`esame`, `visualizzazioni`, `num_segnalazioni`, `num_richieste`, `num_commenti`, `data`, `stato`, `codice`, `nome_pdf`, `anno`)
             values (";
             $query.= "'".mysql_real_escape_string($_POST["esame"])."',";
             $query.= '0'.",";
             $query.= '0'.",";
             $query.= '0'.",";
             $query.= '0'.",";
             $query.= "'".date("Y/m/d h/i/s")."',";
             $query.= "'".mysql_real_escape_string($_POST["stato"])."',";
             $query.= "'".mysql_real_escape_string($_POST["codice"])."',";			 
             $query.= "'".mysql_real_escape_string($_POST["nome_pdf"])."',";
             $query.= "'".mysql_real_escape_string($_POST["anno"])."')";

             $risultato = mysql_query($query) or die("errore con il salvataggio dell\'utente 
             ".$query."<br>".mysql_error());
             header('Location: https://appunticleii.altervista.org/?pag=E');
             exit();
    	}
	}
if($pdf!=''){
	$q = "select * from esami where nome_pdf='".$pdf."'";
	$rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
             ".$query."<br>".mysql_error());
    $esame = mysql_fetch_assoc($rq);
    $esame["visualizzazioni"] += 1;
    echo $esame["visualizzazioni"];
    $q='UPDATE `esami` SET `visualizzazioni` = '.$esame["visualizzazioni"].' WHERE `esami`.`nome_pdf` = "'.$pdf.'";';
    $rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
             ".$q."<br>".mysql_error());
    header("Location: https://appunticleii.altervista.org/appunti/".$esame["anno"]."/".$pdf.".pdf");
    exit();
	}
if($case=='cambio_password' && $pag=='account' && $mess=='' &&  isset($_SESSION["id_ut"])){
	if($_POST["psw"] ==$_POST["cpsw"]){
    	
        $q='UPDATE `utenti` SET `password` = "'.password_hash($_POST["psw"], PASSWORD_DEFAULT).'" WHERE `utenti`.`id_ut` = '.$_SESSION["id_ut"].';';
        $rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
             ".$q."<br>".mysql_error());
        $_SESSION["cambio"]="Password cambiata con successo.";
        header("Location: https://appunticleii.altervista.org/?pag=account");
		exit();
        }
    else{
    	$_SESSION["cambio"]="Password non coincidenti riprova.";
        header("Location: https://appunticleii.altervista.org/?pag=account");
        exit();
        }
    }
    
if($case=='cambio_username' && $pag=='account' && $mess=='' &&  isset($_SESSION["id_ut"])){
	$q = "select * from utenti where username='".$_POST["username"]."'";
	$rq = mysql_query($q) or die("ee1");
	$num = mysql_num_rows($rq);
    if($num==0){
        $q='UPDATE `utenti` SET `username` = "'.$_POST["username"].'" WHERE `utenti`.`id_ut` = '.$_SESSION["id_ut"].';';
        $rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
             ".$q."<br>".mysql_error());
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["cambio"]="Username cambiata con successo.";
        header("Location: https://appunticleii.altervista.org/?pag=account");
		exit();
        }
    else{
    	$_SESSION["cambio"]="Username già usato riprova.";
        header("Location: https://appunticleii.altervista.org/?pag=account");
        exit();
        }
    }
    
if($case=='commento' && $pag=='esame' && $mess=='' &&  isset($_SESSION["id_ut"])){

	$query = "INSERT INTO `commenti` 
             (`commento`,`data`,`fk_id_ut`, `fk_id_esame`)
             values (";
             $query.= "'".mysql_real_escape_string($_POST["commento"])."',";
             $query.= "'".date("Y-m-d H:i:s")."',";
             $query.= "'".$_SESSION["id_ut"]."',";
             $query.= "'".$_SESSION["id_esame"]."')";

             $risultato = mysql_query($query) or die("errore con il salvataggio dell\'utente 
             ".$query."<br>".mysql_error());
	$q = "select num_commenti from esami where esami.id_esame='".$_SESSION["id_esame"]."'";
    $rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
             ".$q."<br>".mysql_error());
    $num_commenti = mysql_fetch_assoc($rq); 
    $num_commenti["num_commenti"] += 1;
    $q = "update esami set num_commenti =".$num_commenti["num_commenti"]." where esami.id_esame='".$_SESSION["id_esame"]."'";
    $rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
             ".$q."<br>".mysql_error());
             
	$q = "select num_commenti from utenti where utenti.id_ut='".$_SESSION["id_ut"]."'";
    $rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
             ".$q."<br>".mysql_error());
    $num_commenti = mysql_fetch_assoc($rq); 
    $num_commenti["num_commenti"] += 1;
    $q = "update utenti set num_commenti =".$num_commenti["num_commenti"]." where utenti.id_ut='".$_SESSION["id_ut"]."'";
    $rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
             ".$q."<br>".mysql_error());
             
             unset($_SESSION["id_esame"]);
             header('Location: https://appunticleii.altervista.org/?pag='.$pag.'&esame='.$esame);
             exit();
	}

if($case=='segnalazione' && $pag=='esame' && $mess=='' &&  isset($_SESSION["id_ut"])){
	
	$query = "INSERT INTO `segnalazioni` 
             (`errore`,`data`,`fk_id_ut`, `fk_id_esame`,`corretto` )
             values (";
             $query.= "'".mysql_real_escape_string($_POST["errore"])."',";
             $query.= "'".date("Y/m/d h/i/s")."',";
             $query.= "'".$_SESSION["id_ut"]."',";
             $query.= "'".$_SESSION["id_esame"]."',";
			 $query.= "'N')";
             $risultato = mysql_query($query) or die("errore con il salvataggio dell\'utente 
             ".$query."<br>".mysql_error());
	
    $q = "select num_segnalazioni from esami where esami.id_esame='".$_SESSION["id_esame"]."'";
    $rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
             ".$q."<br>".mysql_error());
    $num_segnalazioni = mysql_fetch_assoc($rq); 
    $num_segnalazioni["num_segnalazioni"] += 1;
    $q = "update esami set num_segnalazioni =".$num_segnalazioni["num_segnalazioni"]." where esami.id_esame='".$_SESSION["id_esame"]."'";
    $rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
             ".$q."<br>".mysql_error());
	
    $q = "select num_segnalazioni from utenti where utenti.id_ut='".$_SESSION["id_ut"]."'";
    $rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
             ".$q."<br>".mysql_error());
    $num_segnalazioni = mysql_fetch_assoc($rq); 
    $num_segnalazioni["num_segnalazioni"] += 1;
    $q = "update utenti set num_segnalazioni =".$num_segnalazioni["num_segnalazioni"]." where utenti.id_ut='".$_SESSION["id_ut"]."'";
    $rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
             ".$q."<br>".mysql_error());
             
             unset($_SESSION["id_esame"]);
             header('Location: https://appunticleii.altervista.org/?pag='.$pag.'&esame='.$esame);
             exit();
	}

if($pag=='E' && $caso=='' && isset($_SESSION["id_ut"]) && $_SESSION["tipo"]=='A' && $codice !== null){
    	echo $codice;
    	$q = "UPDATE esami SET data='".date("Y-m-d H:i:s")."' WHERE codice='".$codice."';";
        $rq = mysql_query($q)or die("errore con il salvataggio dell\'utente 
             ".$q."<br>".mysql_error());
        header('Location: https://appunticleii.altervista.org/?pag=E');
        exit();
        }
?>