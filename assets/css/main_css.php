<?php
    header('content-type:text/css');
	
	$claro = '#c4e7fb';
	$normal = '#045788';
	$obscuro = '#227ab7';
	$resaltado = '#68b5e2';
	$fondo = '#0678ba';
	$inactivo = '#c4e7fb';
	
	echo'
	*{
	font-family: "Arial Narrow", "MS Trebuchet", Arial, sans-serif;
	margin: 0;
	padding: 0;
	}
	
	#exito,.exito{
	color: #33CC33;
	background-color: #ADEBAD;
	}
	#error,.error{
	color: #FF0000;
	background-color: #FFCCCC;	
	}
	#advertencia,.advertencia{
	color: #FF9900;
	background-color: #FFFF99;
	}
	';
	//include('menu_vertical.php');
	include('menu_horizontal.php');
	include('inicio_sesion.php');
	include('panels.php');
	include('forms.php');
	include('ficha.php');
	include('listado_mini.php');
?>