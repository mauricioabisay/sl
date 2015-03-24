<?php
echo <<<FIN
.busqueda{
	margin: auto;
	width: 35%;
	display: block;
}

.busqueda label{
	display: inline;
}

.busqueda input{
	display: inline;
}

.busqueda fieldset{
	margin: auto;
	padding: 1em;
	text-align: justify;
	display: block;
	border: 2px solid $fondo;
}

.busqueda legend{
	font-weight: bold;
}

.boton{
	color: #000;
	border: 2px solid #000;
	background: #fff;
}

.boton:hover, .boton:focus{
	color: #fff;
	border: 2px solid #fff;
	background: #000;
}

.listado{
	margin: 0em auto;
	width: 80%;
}

.listado td{
	padding: 0.5em;
	border-bottom: 2px solid $obscuro;
}

.listado th{
	border-bottom: 5px solid $obscuro;
}

.listado thead{
	font-size: 105%;
}

.listado tbody{
	font-style: normal;
	text-align: center;
}

.listado tfoot{
	font-style:	italic;
	text-align: center;
	
}

.listado tbody td a{
	margin: 0.2em;
}

.listado .nuevo{
	display: block;
	font-size: 80%;
	border: 0px;
}

.listado_oculto{
	margin: 0em auto;
	width: 80%;
	font-size: 80%;
	display: none;
}

.listado_oculto td{
	padding: 0.2em;
	border-bottom: 1px solid $obscuro;
}

.listado_oculto th{
	border-bottom: 2px solid $obscuro;
}

.listado_oculto thead{
	font-size: 102%;
}

.listado_oculto tbody{
	font-style: normal;
	text-align: center;
}

.listado_oculto tfoot{
	font-style:	italic;
	text-align: center;
	
}

.listado_oculto tbody td a{
	margin: 0.2em;
}

.listado tbody .Confirmada{
	background-color:#ccff33;
}
.listado tbody .Asignada{
	background-color:#ffff00;
}
.listado tbody .Transferida{
	background-color:#6c9cca;
}
.listado tbody .Cancelada{
	background-color:#ff6600;
}
.listado tbody .Pagada{
	color:#fff;
	background-color:#00722d;
}
.listado tbody .Adeudada{
	color:#fff;
	background-color:#bd1e01;
}

FIN;
?>