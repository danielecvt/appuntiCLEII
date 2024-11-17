<?php
//include "appunti/appunti_php/appunti_dirp.php";
foreach (glob("appunti/appunti_php/*.php") as $filename) {
	include_once $filename;
}
//include "appunti/appunti_php/*.php";
function appunti($esame){
	if($esame == "dirp"){
        appunti_dirp();        
        }




	}

?>