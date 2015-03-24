<?php
echo <<<FIN
#formulario {
	margin-top: 0;
	margin-bottom: 0;
	width: 50%;
	display: block;
}

#formulario fieldset{
	margin: auto;
	padding: 1em;
	text-align: justify;
	display: block;
	border: 2px solid $fondo;
}

#formulario legend{
	font-weight: bold;
}

#formulario label{
	display: block;
}

#formulario input{
	display: block;
}

#formulario textarea{
	vertical-align: top;
	display: inline;
	width: 15em;
}

#formulario span{
	margin: 0.1em;
	font-size: 80%;
	text-align: center;
	font-weight: light;
}

#formulario .lineal{
	text-align: justify;
	display: block;
}

#formulario .lineal label{
	display: inline;
}

#formulario .lineal input{
	display: inline;
}

#formulario .lineal_eval{
	text-align: justify;
	display: block;
}

#formulario .lineal_eval label{
	text-align: right;
	display: inline;
	width: 60%;
	float: left;
}

#formulario .lineal_eval input{
	display: inline;
}

#formulario .lineal_eval strong{
	display: inline;
}

#formulario .columna{
	vertical-align:top;
	text-align: justify;
	display: inline;
}

#formulario .columnaizq{
	float: left;
	vertical-align:top;
	text-align: justify;
	display: inline;
}

#formulario .columnader{
	float:right;
	vertical-align:top;
	text-align: justify;
	display: inline;
}

#formulario .botones input{
	display: inline;
	margin: 4em;
	margin-top: 1em;
	font-size: 95%;
	padding: 0.2em;
}

#formulario .botones_lineal input{
	display: inline;
	font-size: 95%;
	padding: 0.2em;
}

.tabla_formulario{
}

.tabla_formulario .titulo{
	color: $normal;
	font-weight: bold;
}

.tabla_formulario td{
	padding: 0.5em;
	border-bottom: 2px solid $obscuro;
}

.tabla_formulario th{
	border-bottom: 5px solid $obscuro;
}

.tabla_formulario thead{
	font-size: 105%;
}

.tabla_formulario tbody{
	font-style: normal;
	text-align: center;
}

.tabla_formulario tfoot{
	font-style:	italic;
	text-align: center;
	
}
FIN;
?>