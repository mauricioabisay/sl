<?php
echo <<<FIN
.listado_mini{
	font-size: 10;
	margin: 0em;
	width: 100%;
}

.listado_mini td{
	padding: 0.2em;
	border-bottom: 1px solid $obscuro;
}

.listado_mini th{
	border-bottom: 2px solid $obscuro;
}

.listado_mini thead{
	font-size: 105%;
}

.listado_mini tbody{
	font-style: normal;
	text-align: center;
}

.listado_mini tfoot{
	font-size: 130%;
	font-weight: bolder;
	font-style:	italic;
	text-align: center;
	margin: 0.5em;
}

.listado_mini tfoot tr td{
border: 0px;
}

.listado_mini tfoot tr td a,a:visited {
color: $resaltado;
}

.listado_mini tfoot tr td a:hover, a:focus {
color: #0000FF;
background-color: #FFF;
}

.listado_mini tbody td a{
	margin: 0.0em;
}

.listado_mini .nuevo{
	display: block;
	font-size: 90%;
	border: 0px;
}

.listado_mini a,a:visited {
color: #0000FF;
font-size: 115%;
}

.listado_mini a:hover, a:focus {
color: #fff;
background-color: $resaltado;
}
FIN;
?>