<?php
session_start();
//set variables
if (isset($_GET['pag']))
 	$pag = filter_input(INPUT_GET,'pag',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
else
  	$pag = null;
if (isset($_GET['id']))
  	$id = filter_input(INPUT_GET,'mess',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
else
  	$id = null;
if (isset($_GET['case']))
  	$case = filter_input(INPUT_GET,'case',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
else
  	$case = null;
if (isset($_GET['codice']))
  	$codice = filter_input(INPUT_GET,'case',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
else
  	$codice = null;
if($_SESSION["tipo"] == 'A' and $pag !== null and $pag !== 'U' and $pag !== 'C' and $pag !== 'S' and $pag !== 'E'){
    header("Location: https://appunticleii.altervista.org");
    exit();
    }
if ($pag=='' && $caso=='' && isset($_SESSION["id_ut"]) && $_SESSION["tipo"]=='A') {
	testata_admin();
    echo'<p><strong><font color="blue" size=5><a href="?pag=U">Utenti</a></font></strong></p>';
    echo'<p><strong><font color="blue" size=5><a href="?pag=C">Commenti</a></font></strong></p>';
    echo'<p><strong><font color="blue" size=5><a href="?pag=S">Segnalazioni</a></font></strong></p>';
    echo'<p><strong><font color="blue" size=5><a href="?pag=E">Esami</a></font></strong></p>';
	footer();
}
if ($pag=='U' && $caso=='' && isset($_SESSION["id_ut"]) && $_SESSION["tipo"]=='A') {
	testata_admin();
    echo'<p><font size=6 color=006600><b>Utenti</b></font></p>';
    echo'<p><font size=5 ><b>Clicca sull\'id_ut per modificare l\'utente</b></font></p>';
    $q = "select id_ut,username,data_reg,tipo,num_segnalazioni,num_richieste,num_commenti,num_login,data_ult_acc from utenti";
    $utenti = mysql_query($q);
    echo '<table style="width:100%; text-align:center;border: 1px solid black">';
      echo'<tr>';
        echo'<th>id_ut</th>';
        echo'<th>username</th>';
        echo'<th>data_reg</th>';
        echo'<th>tipo</th>';
        echo'<th>num_segnalazioni</th>';
        echo'<th>num_richieste</th>';
        echo'<th>num_commenti</th>';
        echo'<th>num_login</th>';
        echo'<th>data_ult_acc</th>';
      echo '</tr>';
    while($utente = mysql_fetch_array($utenti,MYSQL_NUM)){
		echo'<tr>';
        echo'<th style="font-weight: normal"><a href="https://appunticleii.altervista.org/?pag=U&id="'.$utente[0].'>'.$utente[0].'</th>';
        echo'<th style="font-weight: normal">'.$utente[1].'</th>';
        echo'<th style="font-weight: normal">'.$utente[2].'</th>';
        echo'<th style="font-weight: normal">'.$utente[3].'</th>';
        echo'<th style="font-weight: normal">'.$utente[4].'</th>';
        echo'<th style="font-weight: normal">'.$utente[5].'</th>';
        echo'<th style="font-weight: normal">'.$utente[6].'</th>';
        echo'<th style="font-weight: normal">'.$utente[7].'</th>';
        echo'<th style="font-weight: normal">'.date('d/M/Y H:i:s', strtotime($utente[8])).'</th>';
      echo '</tr >';      
    	}
	echo '</table>';

    footer();
    }
if ($pag=='C' && $caso=='' && isset($_SESSION["id_ut"]) && $_SESSION["tipo"]=='A') {
	testata_admin();
    echo'<p><font size=6 color=006600><b>Commenti</b></font></p>';
    footer();
    }
if ($pag=='S' && $caso=='' && isset($_SESSION["id_ut"]) && $_SESSION["tipo"]=='A') {
	testata_admin();
    echo'<p><font size=6 color=006600><b>Segnalazioni</b></font></p>';
    footer();
    }
if ($pag=='E' && $caso=='' && isset($_SESSION["id_ut"]) && $_SESSION["tipo"]=='A') {
	testata_admin();
    echo'<p><font size=6 color=006600><b>Esami</b></font></p>';
    $q = "select esame,codice from esami";
    $esami = mysql_query($q);
    while($esame = mysql_fetch_array($esami,MYSQL_NUM)){
    	echo "<font size=5>".$esame[0]. "</font>";
        echo '<a href="pagine_di_funzionamento/action_page.php?pag=E&codice='.$esame[1].'">aggiorna data</a><br>';
        }
    register_esame();
    footer();
    }
?>