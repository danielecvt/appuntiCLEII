<?php
include 'login.php';
include 'navbar.php';
include 'register.php';
include 'segnalazione.php';
include 'pagine/appunti.php';
session_start();

function privacy_policy(){
	echo'<link rel="preload" as="script" href="https://cdn.iubenda.com/cs/iubenda_cs.js"/>';
echo'<link rel="preload" as="script" href="https://cdn.iubenda.com/cs/tcf/stub-v2.js"/>';
echo'<script src="https://cdn.iubenda.com/cs/tcf/stub-v2.js"></script>';
echo'<script>';
echo'(_iub=self._iub||[]).csConfiguration={';
	echo'cookiePolicyId: 76889939,';
	echo'siteId: 3805053,';
	echo"localConsentDomain: 'appunticleii.altervista.org',";
	echo'timeoutLoadConfiguration: 30000,';
	echo"lang: 'it',";
	echo'enableTcf: true,';
	echo'tcfVersion: 2,';
	echo'tcfPurposes: {';
		 echo'"2": "consent_only",';
		 echo'"3": "consent_only",';
		 echo'"4": "consent_only",';
		echo' "5": "consent_only",';
		 echo'"6": "consent_only",';
		 echo'"7": "consent_only",';
		 echo'"8": "consent_only",';
		 echo'"9": "consent_only",';
		echo'"10": "consent_only"';
	echo'},';
	echo'invalidateConsentWithoutLog: true,';
	echo'googleAdditionalConsentMode: true,';
	echo'consentOnContinuedBrowsing: false,';
	echo'banner: {';
		echo'position: "top",';
		echo'acceptButtonDisplay: true,';
		echo'customizeButtonDisplay: true,';
		echo'closeButtonDisplay: true,';
		echo'closeButtonRejects: true,';
		echo'fontSizeBody: "14px",';
	echo'},';
echo'}';
echo'</script>';
echo'<script async src="https://cdn.iubenda.com/cs/iubenda_cs.js"></script>';
    }
    
    
function testata($codice){
	echo "<!DOCTYPE HTML>\n";
    echo '<html lang="it">'."\n";
    echo "<head>\n" ;       
        echo '<link rel="shortcut icon" href="icona_appunti_CLEII.png" type="image/x-icon"/>';
        echo '<title>Appunti CLEII</title>'."\n";
        $q = "select * from esami where codice='".$codice."'";
		$rq = mysql_query($q) or die("ee1");
    	$esame = mysql_fetch_assoc($rq);
        if($codice != '' && $esame["stato"] == 'P'){//google AdSense
        	echo'<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7381407919262531"
     		crossorigin="anonymous"></script>';
            }         
        echo '<meta charset="UTF-8">'."\n";
        echo'<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo'<style>';
			echo'.myDiv {';
  				echo'max-width: 1000px;';
                echo'margin: 0 auto';
				echo'}';
            navbar_style();
            login_style();
		echo'</style>';
        privacy_policy();
    echo "</head>\n";
    echo '<body>';
    	echo'<div class=myDiv>';
    		echo'<p align="center" ><font  color=006600 size=7><b>Appunti CLEII</b></font></p>';
	}

function testata_pubblica($codice) {
    testata($codice);
    navbar_pubblica();    
    login();
    //login_richiesta();
	}
    
function testata_privata() {
	testata($codice);
    navbar_privata(); 
	echo '<p  align=right><font size=5>Logged in as <b>'.$_SESSION["username"].'</b></font></p>';
	}
    
function footer() {
			echo'<a href="https://www.iubenda.com/privacy-policy/76889939" rel="noreferrer nofollow" target="_blank">Privacy Policy</a>
			- <a href="#" role="button" class="iubenda-advertising-preferences-link">Personalizza tracciamento pubblicitario</a>';
		echo'</div>';
            echo "</body>\n";
    echo "</html>\n";
    }
    
function footer_esami() {
		if (isset($_GET['pag']))
            $pag = filter_input(INPUT_GET,'pag',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        else
            $pag = null;
        if (isset($_GET['esame']))
            $codice = filter_input(INPUT_GET,'esame',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        else
            $codice = null;
        if (isset($_GET['richiesta']))
            $richiesta = filter_input(INPUT_GET,'richiesta',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        else
            $richiesta = 'false';
            
		$q = "select * from esami where codice='".$codice."'";
		$rq = mysql_query($q) or die("ee1");
        $esame = mysql_fetch_assoc($rq);
        //add
        echo'<div align=center><script>!function(d,l,e,s,c){e=d.createElement("script");e.src="//ad.altervista.org/js.ad/size=728X90/?ref="+encodeURIComponent(l.hostname+l.pathname)+"&r="+Date.now();s=d.scripts;c=d.currentScript||s[s.length-1];c.parentNode.insertBefore(e,c)}(document,location)</script></div>';

        echo'<p><font size=6 color=006600><b>'.$esame["esame"].'</b></font></p>';
        //add
		echo'<div align=center><script>!function(d,l,e,s,c){e=d.createElement("script");e.src="//ad.altervista.org/js.ad/size=300X250/?ref="+encodeURIComponent(l.hostname+l.pathname)+"&r="+Date.now();s=d.scripts;c=d.currentScript||s[s.length-1];c.parentNode.insertBefore(e,c)}(document,location)</script></div>';
        
		if($esame["stato"]=='P'){
        	echo'<p align=center><font size=5><a href="https://appunticleii.altervista.org/pagine_di_funzionamento/action_page.php/?pdf='.$esame['nome_pdf'].'"><b>Vai agli appunti in PDF</b></a></font></p>';
        	echo'<p><font size=4>Appunti visti '.$esame['visualizzazioni'];
			if ($esame['visualizzazioni']==1)
            	echo' volta.</p>';
            else
            	echo' volte.</p>';
            echo'<p>Data di caricamento '.date('d/M/Y H:i:s', strtotime($esame["data"])).'.</p>';
            appunti($codice);
            
            if (!isset($_SESSION["id_ut"]))
        		echo"<p><font size=5>Hai trovato un errore? Fai una <font color=blue><u><a onclick="."document.getElementById('id01').style.display='block'".">segnalazione</a></u></font>.</p>";
			else
			    echo"<p><font size=5>Hai trovato un errore? Fai una <font color=blue><u><a onclick="."document.getElementById('segn').style.display='block'".">segnalazione</a></u></font>.</p>";  	
        	//add
            
            segnalazione();
			commenti();
            }
        if($esame["stato"]=='C'){
        	echo"<p><font size=5>Sto scrivendo questi appunti attendi :/</font></p>";
			
            }
        if($esame["stato"]=='R'){
        	if (isset($_GET['esame']))
                $esame = filter_input(INPUT_GET,'esame',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            else
                $esame = null;
        	$q = "select num_richieste,id_esame from esami where codice='".$esame."'";
            $rq = mysql_query($q);
            $rq_esame = mysql_fetch_assoc($rq);
            $q = "select id_richiesta from richiede where fk_id_ut='".$_SESSION["id_ut"]."' and fk_id_esame='".$rq_esame["id_esame"]."'";
            $rq = mysql_query($q);
            $richiesta = mysql_num_rows($rq); //this can be 0 or 1
        	if(isset($_SESSION["richiesta"]) && $_SESSION["richiesta"]){
        		echo'<p align=center><font size=6 color=006600><b>Richiesta inviata con successo.</b></font></p>';
                $_SESSION["richiesta"] = false;
                }
			if (!isset($_SESSION["id_ut"]))
        		echo"<p><font size=5>Vuoi gli appunti di questo esame? Fai una <font color=blue><u><a onclick="."document.getElementById('id01').style.display='block'".">richiesta</a></u></font>.</p>";
			else{
                if ($richiesta)
                 	echo"<p><font size=5>Richiesta già effettuata.</font></p>";
				else
                    echo"<p><font size=5>Vuoi gli appunti di questo esame? Fai una <font color=blue><u><a href='https://appunticleii.altervista.org/pagine_di_funzionamento/action_page.php?pag=".$pag."&esame=".$esame."&richiesta=true'>richiesta</a></u></font>.</p>";  	
                }
                if($rq_esame["num_richieste"] == 1)
            		echo"<p><font size=5>È stata effettuata ".$rq_esame["num_richieste"]." richiesta per questo esame.</font></p>"; 
				else{
                	if($rq_esame["num_richieste"] == NULL)
            			echo"<p><font size=5>Sono state effettuate 0 richieste per questo esame.</font></p>"; 
					else
                    	echo"<p><font size=5>Sono state effettuate ".$rq_esame["num_richieste"]." richieste per questo esame.</font></p>"; 
                    }
            /*
            echo'<font size=4>Vuoi che i tuoi appunti siano caricati qui? Inviali.</font>';
            echo'<form method="post" action="pagine_di_funzionamento/action_page.php" enctype="multipart/form-data">';
            	echo'<input type="file" name="file" >';
            echo'</form>';*/
            }
           
            echo'<font size=4><br><a href="https://www.iubenda.com/privacy-policy/76889939" rel="noreferrer nofollow" target="_blank">Privacy Policy</a>
			- <a href="#" role="button" class="iubenda-advertising-preferences-link">Personalizza tracciamento pubblicitario</a></font>';
 
        echo'</div>';
        
    echo "</body>\n";
    echo "</html>\n";
    }
    
function testata_admin(){
	echo "<!DOCTYPE HTML>\n";
    echo '<html lang="it">'."\n";
    echo "<head>\n" ;
        echo '<link rel="shortcut icon" href="icona_appunti_CLEII.png" type="image/x-icon"/>';
        echo '<title>Appunti CLEII</title>'."\n";
        echo '<meta charset="UTF-8">'."\n";
        echo'<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo'<style>';
			echo'.myDiv {';
  				echo'max-width: 1000px;';
                echo'margin: 0 auto';
				echo'}';
                login_style();
                navbar_style();
		echo'</style>';
    echo "</head>\n";
    echo '<body>';
    	echo'<div class=myDiv>';
    		echo'<p align="center" ><font  color=006600 size=7><b>Appunti CLEII</b></font></p>';
            navbar_admin(); 
            echo '<p  align=right><font size=5>Logged in as <b>'.$_SESSION["username"].'</b></font></p>';
			echo'<p><font size=6 color=006600><b>Interfaccia admin</b></font></p>';

    }
?>