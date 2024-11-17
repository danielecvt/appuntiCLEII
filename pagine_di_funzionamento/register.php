<?php
function register(){
	echo'<div>';
	   	echo'<form action="/pagine_di_funzionamento/action_page.php" method="post">';
        	echo'<div class="container">';
              	echo'<label for="uname"><b>Username</b></label>';
              	echo'<input type="text" placeholder="Enter Username" name="uname" maxlength="30" required>';
                
              	echo'<label for="psw"><b>Password</b></label>';
              	echo'<input type="password" placeholder="Enter Password" name="psw" required>';
                
                echo'<label for="cpsw"><b>Conferma password</b></label>';
              	echo'<input type="password" placeholder="Enter Password" name="cpsw" required>';
                
				echo'<div style="text-align: center">';
              		echo'<button type="submit" style="width:auto;">Registrati</button>';
                	echo '<input type="hidden" name="case" value="registrazione">'."\n";                    
                echo'</div>';

          	echo'</div>';
/*
          	echo'<div class="container" style="background-color:#f1f1f1">';
              	//echo"<button type="."button"." onclick="."document.getElementById('reg').style.display='none'"." class="."cancelbtn".">Annulla</button>";
              	echo'<font size=5><a href="https://appunticleii.altervista.org"><b>Annulla</b></a></font>';
                echo'</div>';*/
      	echo'</form>';
		echo'</div>';
/*
    echo'<script>';
      // Get the modal
      echo"var modal = document.getElementById('reg');";

      // When the user clicks anywhere outside of the modal, close it
      echo'window.onclick = function(event) {';
          echo'if (event.target == modal) {';
              echo'modal.style.display = "none";';
          echo'}';
      echo'}';
    echo'</script>';*/
	}
function register_esame(){
	echo'<div>';
	   	echo'<form action="/pagine_di_funzionamento/action_page.php" method="post">';
        	echo'<div class="container">';
              	echo'<label for="esame"><b>Nome esame</b></label>';
              	echo'<input type="text" placeholder="Enter esame" name="esame" required>';
                
              	echo'<label for="stato"><b>Stato</b></label>';
              	echo'<input type="text" placeholder="Enter stato, iniziale di Cantiere/Pronto/Richiesta" name="stato" required>';
                
                echo'<label for="codice"><b>Codice esame</b></label>';
              	echo'<input type="text" placeholder="Enter codice" name="codice" required>';
                
                echo'<label for="nome_pdf"><b>Nome pdf</b></label>';
              	echo'<input type="text" placeholder="Enter nome_pdf" name="nome_pdf" required>';
                
                echo'<label for="anno"><b>Anno</b></label>';
                echo'<select name="anno">';
					echo'<option value="Primo">Primo</option>';
					echo'<option value="Secondo">Secondo</option>';
					echo'<option value="Terzo">Terzo</option>';
				echo'</select>';
                
				echo'<div style="text-align: center">';
              		echo'<button type="submit" style="width:auto;">Aggiungi</button>';
                	echo '<input type="hidden" name="case" value="reg_esame">'."\n";                    
                echo'</div>';

          	echo'</div>';
/*
          	echo'<div class="container" style="background-color:#f1f1f1">';
              	//echo"<button type="."button"." onclick="."document.getElementById('reg').style.display='none'"." class="."cancelbtn".">Annulla</button>";
              	echo'<font size=5><a href="https://appunticleii.altervista.org"><b>Annulla</b></a></font>';
                echo'</div>';*/
      	echo'</form>';
		echo'</div>';
        }
?>