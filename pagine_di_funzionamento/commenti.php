<?php
function commenti(){
    if (isset($_GET['pag']))
        $pag = filter_input(INPUT_GET,'pag',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    else
        $pag = null;  
    if (isset($_GET['esame']))
        $esame = filter_input(INPUT_GET,'esame',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    else
        $esame = null; 
    
	$q = "SELECT id_esame FROM esami WHERE esami.codice='".$esame."'";
    $rq = mysql_query($q) or die('ee1');
    $esameq = mysql_fetch_assoc($rq);
    $_SESSION["id_esame"]=$esameq["id_esame"]; 	
    echo'<div>';
    	if(isset($_SESSION["id_ut"])){

            echo'<form action="/pagine_di_funzionamento/action_page.php?pag='.$pag.'&esame='.$esame.'" method="post">';
                echo'<div class="container">';
                        echo'<input type="text" placeholder="Aggiungi un commento..." name="commento" required>';
                    echo'<div >';
                        echo'<button type="submit" style="width:auto;">Invia</button>';
                        echo '<input type="hidden" name="case" value="commento">'."\n";                    
                    echo'</div>';

                echo'</div>';
            echo'</form>';
                }else
                    echo"<font color=blue><u><a onclick="."document.getElementById('id01').style.display='block'".">Accedi</a></u></font> per aggiungere un commento.";
	echo'</div>';
    
    $q = "SELECT commento, data, fk_id_ut FROM commenti WHERE commenti.fk_id_esame='".$_SESSION["id_esame"]."'";
    $commenti = mysql_query($q) or die('ee2');
	$num = mysql_num_rows($commenti);
    if ($num > 0) {
    	if ($num == 1)
        	echo "<font size=4><br> 1 commento.</font>";
        else
        	echo "<font size=4><br>".$num." commenti.</font>";
        echo'<br><br>';
        while($commento = mysql_fetch_array($commenti)) {
        	$q = "SELECT username FROM utenti WHERE utenti.id_ut='".$commento["fk_id_ut"]."'";
    		$rq = mysql_query($q) or die('ee1');
    		$utente = mysql_fetch_assoc($rq);
            echo "<div><strong>" . htmlspecialchars($utente['username']) . "</strong> " . date('d/M/Y H:i:s A', strtotime($commento['data'])) . "<br>";
            echo "<p>" . htmlspecialchars($commento['commento']) . "</p></div><hr>";
        }
    } else
        echo "<font size=4><br>Nessun commento.</font>";
    } 
    ?>