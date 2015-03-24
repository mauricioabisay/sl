<?php
echo <<<FIN
#ficha {
	margin-top: 0;
	margin-bottom: 0;
	width: 60%;
	display: block;
}

#ficha fieldset{
	margin: auto;
	padding: 1em;
	text-align: justify;
	display: block;
	border: 2px solid $fondo;
}

#ficha legend{
	font-weight: bold;
}

#ficha fieldset fieldset{
	margin: 0.5em;
	padding: 0.5em;
	text-align: justify;
	display: block;
	border: 1px solid $fondo;
}

#ficha .foto{
	margin: auto;
	padding: 0.5em;
	text-align: justify;
	float:right;
	vertical-align:top;
	display: inline;
}

#ficha label{
	font-size: 90%;
	color: $normal;
	display: block;
}

#ficha span{
	margin: 0.2em;
	font-size: 100%;
	display: inline;
}

#ficha .texto{
	font-size: 100%;
	display: block;
}

#ficha .lineal{
	text-align: justify;
	display: block;
}

#ficha .lineal label{
	font-size: 90%;
	color: $normal;
	display: inline;
}

#ficha .lineal span{
	font-size: 100%;
	display: inline;
}

#ficha .lineal_oculto{
	text-align: justify;
	display: none;
}

#ficha .lineal_oculto label{
	font-size: 90%;
	color: $normal;
	display: inline;
}

#ficha .lineal_oculto span{
	font-size: 100%;
	display: inline;
}

#ficha .columna{
	margin: 1em;
	vertical-align:top;
	text-align: justify;
	display: inline;
}

#ficha .columnaizq{
	float: left;
	vertical-align:top;
	text-align: justify;
	display: inline;
}

#ficha .columnader{
	float:right;
	vertical-align:top;
	text-align: justify;
	display: inline;
}
FIN;
?>