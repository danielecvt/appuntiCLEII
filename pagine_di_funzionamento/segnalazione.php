<?php
function segnalazione(){
	if (isset($_GET['pag']))
 		$pag = filter_input(INPUT_GET,'pag',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	else
  		$pag = null;
    if (isset($_GET['esame']))
 		$esame = filter_input(INPUT_GET,'esame',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	else
  		$esame = null;
    $q = "select id_esame,esame from esami where esami.codice='".$esame."'";
    $rq = mysql_query($q);
    $rqesame = mysql_fetch_assoc($rq);
    $_SESSION["id_esame"] = $rqesame["id_esame"];
    echo'<div id="segn" class="modal">';
            echo'<form class="modal-content animate" action="/pagine_di_funzionamento/action_page.php?pag='.$pag.'&esame='.$esame.'" method="post">';
                echo'<div class="container">';
                    echo'<label for="esame"><b>Esame</b></label>';
                    echo'<input type="text" value="'.$rqesame["esame"].'" readonly="y" name="esame">';

                    echo'<label for="pagina"><b>Pagina</b></label><br>';
                    echo'<input type="number" placeholder="Enter page number" min=1 max=120 name="pagina"><br>';

                    echo'<label for="errore"><b>Descrivi l\'errore</b></label>';
                    echo'<input type="text" placeholder="Enter error" name="errore" required>';

                    echo'<div style="text-align: center">';
                        echo'<button type="submit" style="width:auto;">Invia</button>';
                        echo '<input type="hidden" name="case" value="segnalazione">'."\n";                    
                    echo'</div>';

                echo'</div>';

                echo'<div class="container" style="background-color:#f1f1f1">';
                    echo"<button type="."button"." onclick="."document.getElementById('segn').style.display='none'"." class="."cancelbtn".">Annulla</button>";
                    echo'</div>';
            echo'</form>';
            echo'</div>';

        echo'<script>';
          // Get the modal
          echo"var modal = document.getElementById('segn');";

          // When the user clicks anywhere outside of the modal, close it
          echo'window.onclick = function(event) {';
              echo'if (event.target == modal) {';
                  echo'modal.style.display = "none";';
              echo'}';
          echo'}';
        echo'</script>';
    }
?>