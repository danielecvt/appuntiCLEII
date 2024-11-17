<?php
function navbar_style(){
	/*echo'body {';
			  echo'font-family: "Lato", sans-serif;';
			echo'}';*/

            echo'.sidenav {';
             echo' height: 100%;';
             echo' width: 0;';
             echo' position: fixed;';
              echo'z-index: 1;';
              echo'top: 0;';
              echo'left: 0;';
              echo'background-color: #111;';
             echo' overflow-x: hidden;';
             echo' transition: 0.5s;';
             echo' padding-top: 60px;';
            echo'}';

            echo'.sidenav a {';
             echo' padding: 8px 8px 8px 32px;';
             echo' text-decoration: none;';
             echo' font-size: 25px;';
             echo' color: #818181;';
            echo'  display: block;';
            echo'  transition: 0.3s;';
            echo'}';

            echo'.sidenav a:hover {';
            echo'  color: #f1f1f1;';
            echo'}';

            echo'.sidenav .closebtn {';
            echo'  position: absolute;';
            echo'  top: 0;';
             echo' right: 25px;';
              echo'font-size: 36px;';
             echo' margin-left: 50px;';
            echo'}';
			/*
            echo'@media screen and (max-height: 450px) {';
             echo' .sidenav {padding-top: 15px;}';
              echo'.sidenav a {font-size: 18px;}';
            echo'}';
            echo'}';*/
	}
function navbar_pubblica(){
	echo'<div id="id02" class="sidenav">';
        echo'<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>';
        echo'<a href="https://appunticleii.altervista.org/">About</a>';
        echo"<a onclick="."document.getElementById('id01').style.display='block'".">Login</a>";
        echo'<a href="https://appunticleii.altervista.org/?pag=p">Primo anno</a>';
        echo'<a href="https://appunticleii.altervista.org/?pag=s">Secondo anno</a>';
        echo'<a href="https://appunticleii.altervista.org/?pag=t">Terzo anno</a>';
	echo'</div>';
    echo'<span style="font-size:30px;cursor:pointer" onclick="openNav()" >&#9776;Menù</span>';
    echo'<script>';
        echo'function openNav() {';
    	echo"var modal = document.getElementById('id02');";
        echo' modal.style.width = "250px";';
        echo'}';

        echo'function closeNav() {';
    	echo"var modal = document.getElementById('id02');";
        echo' modal.style.width = "0";';
        echo'}';
        
		echo"var modal = document.getElementById('id02');";
		echo'window.onclick = function(event) {';
        	echo'if (event.target == modal) {';
            	echo'modal.style.width = "0";';
          		echo'}';
      		echo'}';
	echo'</script>';           
		}
function navbar_privata(){
	echo'<div id="mySidenav" class="sidenav">';
        echo'<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>';
        echo'<a href="https://appunticleii.altervista.org/">About</a>';
        echo'<a href="https://appunticleii.altervista.org/pagine_di_funzionamento/action_page.php?pag=logout">Logout</a>';
        echo'<a href="https://appunticleii.altervista.org/?pag=account">Account</a>';
        echo'<a href="https://appunticleii.altervista.org/?pag=p">Primo anno</a>';
        echo'<a href="https://appunticleii.altervista.org/?pag=s">Secondo anno</a>';
        echo'<a href="https://appunticleii.altervista.org/?pag=t">Terzo anno</a>';
        echo'</div>';
        echo'<span style="font-size:30px;cursor:pointer" onclick="openNav()" >&#9776;Menù</span>';
        echo'<script>';
        echo'function openNav() {';
        echo' document.getElementById("mySidenav").style.width = "250px";';
        echo'}';

        echo'function closeNav() {';
        echo' document.getElementById("mySidenav").style.width = "0";';
        echo'}';
        echo'</script>';
	}
function navbar_admin(){
	echo'<div id="mySidenav" class="sidenav">';
        echo'<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>';
        echo'<a href="https://appunticleii.altervista.org/">Home</a>';
        echo'<a href="https://appunticleii.altervista.org/pagine_di_funzionamento/action_page.php?pag=logout">Logout</a>';
        echo'<a href="https://appunticleii.altervista.org/?pag=U">Utenti</a>';
        echo'<a href="https://appunticleii.altervista.org/?pag=C">Commenti</a>';
        echo'<a href="https://appunticleii.altervista.org/?pag=S">Segnalazioni</a>';
        echo'<a href="https://appunticleii.altervista.org/?pag=E">Esami</a>';

        echo'</div>';
        echo'<span style="font-size:30px;cursor:pointer" onclick="openNav()" >&#9776;Menù</span>';
        echo'<script>';
        echo'function openNav() {';
        echo' document.getElementById("mySidenav").style.width = "250px";';
        echo'}';

        echo'function closeNav() {';
        echo' document.getElementById("mySidenav").style.width = "0";';
        echo'}';
        echo'</script>';
	}
?>