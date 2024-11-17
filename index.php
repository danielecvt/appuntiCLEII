<?php
include 'pagine_di_funzionamento/mysql_fix.php';
session_start();
//set variables
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

//echo session_encode();

$conn = mysql_connect("localhost","root","") or die("errore di connessione");
$db = mysql_select_db("my_appunticleii") or die("errore di selezione del database");


//if(isset( $_COOKIE["username"]))
	//echo'ciao';

if(isset($_COOKIE["username"]) && !isset($_SESSION["id_ut"])){
    if($pag==''){
    	header("Location: https://appunticleii.altervista.org/pagine_di_funzionamento/action_page.php");           
        exit();
        }else{
        	if($esame==''){
            header("Location: https://appunticleii.altervista.org/pagine_di_funzionamento/action_page.php?pag=".$pag);
            exit();
          	}else{
            	header("Location: https://appunticleii.altervista.org/pagine_di_funzionamento/action_page.php?pag=".$pag.'&esame='.$esame); 
            	exit();
         		}
        }
    }

include "pagine_di_funzionamento/about.php";
include "pagine_di_funzionamento/testata_footer.php";
include "pagine_di_funzionamento/action_page.php";
include "pagine/pagine_pubbliche.php";
include "pagine/pagine_private.php";
include "pagine/pagine_admin.php";
?>