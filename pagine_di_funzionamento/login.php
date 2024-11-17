<?php
function return_stato_esame($esame){
	$conn = mysql_connect("localhost","root","") or die("errore di connessione");
	$db = mysql_select_db("my_appunticleii") or die("errore di selezione del database");
	$q = "select `stato` from `esami` where `esami`.`codice`='".$esame."'";
    $rq = mysql_query($q) or die("errore con il salvataggio dell\'utente 
             ".$q."<br>".mysql_error());
    $stato = mysql_fetch_assoc($rq);
    return $stato;
    }
function login(){
	if (isset($_GET['pag']))
 		$pag = filter_input(INPUT_GET,'pag',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	else
  		$pag = null;
    if (isset($_GET['esame']))
 		$esame = filter_input(INPUT_GET,'esame',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	else
  		$esame = null;
	echo"<div id='id01' class='modal'>";
    	if($pag==''or $pag == 'registrazione_avvenuta' or $pag == 'recupero')
        	echo'<form class="modal-content animate" action="/pagine_di_funzionamento/action_page.php" method="post">';
		else{
        	if($esame=='')
	   			echo'<form class="modal-content animate" action="/pagine_di_funzionamento/action_page.php?pag='.$pag.'" method="post">';
			else
	   			echo'<form class="modal-content animate" action="/pagine_di_funzionamento/action_page.php?pag='.$pag.'&esame='.$esame.'" method="post">';
        	}
        echo'<div class="container">';

			echo'<label for="uname"><b>Username</b></label>';
              	echo'<input type="text" placeholder="Enter Username" name="uname" required>';

              	echo'<label for="psw"><b>Password</b></label>';
              	echo'<input type="password" placeholder="Enter Password" name="psw" required>';
				echo'<div style="text-align: center">';
              		echo'<button type="submit" style="width:auto;">Login</button>';
                    $stato = return_stato_esame($esame);
                   /* if($stato["stato"] == 'R')
                    	echo '<input type="hidden" name="case" value="login_richiesta">'."\n";
                   else*/
                    	echo '<input type="hidden" name="case" value="login">'."\n";
                    
                    echo'<label>';
                        echo'<p><font size=5><input type="checkbox" checked="checked" name="connesso">ricordati di me</font></p>';
                    echo'</label>';
                    
                echo'</div>';
                echo'<div style="text-align: center">';
                	echo'<p><font size=5>Non hai un account? <a href="https://appunticleii.altervista.org/?pag=registrazione"><u><font color="blue">Registrati</font></u></a>.</font></p>';
                	echo'<p><font size=5>Usa <a href="https://appunticleii.altervista.org/?pag=recupero"><u><font color="blue">chiave di recupero account</font></u></a>.</font></p>';

                echo'</div>';

          	echo'</div>';

          	echo'<div class="container" style="background-color:#f1f1f1">';
              	echo"<button type="."button"." onclick="."document.getElementById('id01').style.display='none'"." class="."cancelbtn".">Annulla</button>";
              	//echo'<span class="psw"><a href="#">Forgot password?</a></span>';
              	echo'</div>';
      	echo'</form>';
		echo'</div>';

    echo'<script>';
      // Get the modal
      echo"var modal = document.getElementById('id01');";

      // When the user clicks anywhere outside of the modal, close it
      echo'window.onclick = function(event) {';
          echo'if (event.target == modal) {';
              echo'modal.style.display = "none";';
          echo'}';
      echo'}';
    echo'</script>';

	}
    /*
function login_richiesta(){
	if (isset($_GET['pag']))
 		$pag = filter_input(INPUT_GET,'pag',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	else
  		$pag = null;
    if (isset($_GET['esame']))
 		$esame = filter_input(INPUT_GET,'esame',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	else
  		$esame = null;
	echo'<div id="id02" class="modal">';
    	if($pag=='')
        	echo'<form class="modal-content animate" action="/pagine_di_funzionamento/action_page.php" method="post">';
		else{
        	if($esame=='')
	   			echo'<form class="modal-content animate" action="/pagine_di_funzionamento/action_page.php?pag='.$pag.'" method="post">';
			else
	   			echo'<form class="modal-content animate" action="/pagine_di_funzionamento/action_page.php?pag='.$pag.'&esame='.$esame.'" method="post">';
        	}
        echo'<div class="container">';

			echo'<label for="uname"><b>Username</b></label>';
              	echo'<input type="text" placeholder="Enter Username" name="uname" required>';

              	echo'<label for="psw"><b>Password</b></label>';
              	echo'<input type="password" placeholder="Enter Password" name="psw" required>';
				echo'<div style="text-align: center">';
              		echo'<button type="submit" style="width:auto;">Login</button>';
                    echo '<input type="hidden" name="case" value="login_richiesta">'."\n";
                    
                    //echo'<label>';
                      //  echo'<input type="checkbox" checked="checked" name="remember"> Remember me';
                    //echo'</label>';
                    
                echo'</div>';
                echo'<div style="text-align: center">';
                	echo'Non hai un account? <a href="https://appunticleii.altervista.org/?pag=reg"><u><font color="blue">Registrati</font></u></a>.';
                echo'</div>';

          	echo'</div>';

          	echo'<div class="container" style="background-color:#f1f1f1">';
              	echo"<button type="."button"." onclick="."document.getElementById('id02').style.display='none'"." class="."cancelbtn".">Annulla</button>";
              	//echo'<span class="psw"><a href="#">Forgot password?</a></span>';
              	echo'</div>';
      	echo'</form>';
		echo'</div>';

    echo'<script>';
      // Get the modal
      echo"var modal = document.getElementById('id02');";

      // When the user clicks anywhere outside of the modal, close it
      echo'window.onclick = function(event) {';
          echo'if (event.target == modal) {';
              echo'modal.style.display = "none";';
          echo'}';
      echo'}';
    echo'</script>';

	}*/


function login_style(){
    /* Full-width input fields */
echo'input[type=text], input[type=password] {';
  echo'width: 100%;';
  echo'padding: 12px 20px;';
  echo'margin: 8px 0;';
  echo'display: inline-block;';
  echo'border: 1px solid #ccc;';
  echo'box-sizing: border-box;';
echo'}';

/* Set a style for all buttons */
echo'button {';
  	echo'background-color: #006600;';
  	echo'color: white;';
  	echo'padding: 14px 20px;';
  	echo'margin: 8px 0;';
  	echo'border: none;';
  	echo'cursor: pointer;';
  	echo'width: 100%;';
echo'}';

echo'button:hover {';
  echo'opacity: 0.8;';
echo'}';

/* Extra styles for the cancel button */
echo'.cancelbtn {';
  echo'width: auto;';
  echo'padding: 10px 18px;';
  echo'background-color: #f44336;';
echo'}';

/* Center the image and position the close button */
/*
echo'.imgcontainer {';
  echo'text-align: center;';
  echo'margin: 24px 0 12px 0;';
  echo'position: relative;';
echo'}';*/

echo'.container {';
  echo'padding: 16px;';
echo'}';

echo'span.psw {';
  echo'float: right;';
  echo'padding-top: 16px;';
echo'}';

/* The Modal (background) */
echo'.modal {';
  echo'display: none;'; /* Hidden by default */
  echo'position: fixed;'; /* Stay in place */
 echo' z-index: 1;'; /* Sit on top */
  echo'left: 0;';
  echo'top: 0;';
  echo'width: 100%;'; /* Full width */
  echo'height: 100%;'; /* Full height */
  echo'overflow: auto;'; /* Enable scroll if needed */
  echo'background-color: rgb(0,0,0);'; /* Fallback color */
  echo'background-color: rgba(0,0,0,0.4);'; /* Black w/ opacity */
  echo'padding-top: 60px;';
echo'}';

/* Modal Content/Box */
echo'.modal-content {';
  echo'background-color: #fefefe;';
  echo'margin: 5% auto 15% auto;'; /* 5% from the top, 15% from the bottom and centered */
  echo'border: 1px solid #888;';
  echo'width: 80%;'; /* Could be more or less, depending on screen size */
echo'}';

/* The Close Button (x) */
/*
echo'.close {';
  echo'position: absolute;';
  echo'right: 25px;';
  echo'top: 0;';
  echo'color: #000;';
  echo'font-size: 35px;';
  echo'font-weight: bold;';
echo'}';*/

echo'.close:hover,';
echo'.close:focus {';
  echo'color: red;';
  echo'cursor: pointer;';
echo'}';

/* Add Zoom Animation */
echo'.animate {';
  echo'-webkit-animation: animatezoom 0.6s;';
  echo'animation: animatezoom 0.6s';
echo'}';

echo'@-webkit-keyframes animatezoom {';
  echo'from {-webkit-transform: scale(0)} ';
  echo'to {-webkit-transform: scale(1)}';
echo'}';
  
echo'@keyframes animatezoom {';
  echo'from {transform: scale(0)} ';
  echo'to {transform: scale(1)}';
echo'}';

/* Change styles for span and cancel button on extra small screens */
echo'@media screen and (max-width: 300px) {';
  echo'span.psw {';
     echo'display: block;';
     echo'float: none;';
  echo'}';
  echo'.cancelbtn {';
     echo'width: 100%;';
  echo'}';
echo'}';
	}

    

?>