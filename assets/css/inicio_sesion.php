<?php
echo <<<FIN
#inicio_sesion {
	margin: auto;
	width: 15%;
	display: block;
}

#inicio_sesion fieldset{
	margin: auto;
	padding: 1em;
	text-align: justify;
	display: block;
	border: 2px solid $fondo;
}

#inicio_sesion legend{
	font-weight: bold;
}

#inicio_sesion label{
	display: block;
}

#inicio_sesion input{
	display: block;
}

#inicio_sesion .lineal{
	text-align: justify;
	display: block;
}

#inicio_sesion .lineal label{
	display: inline;
}

#inicio_sesion .lineal input{
	display: inline;
}

#inicio_sesion .columna{
	vertical-align:top;
	text-align: justify;
	display: inline;
}

#inicio_sesion .columnaizq{
	float: left;
	vertical-align:top;
	text-align: justify;
	display: inline;
}

#inicio_sesion .columnader{
	float:right;
	vertical-align:top;
	text-align: justify;
	display: inline;
}

#inicio_sesion .botones input{
	margin: 1em 0.5em 0 0.5em;
	display: inline;
}
FIN;
?>