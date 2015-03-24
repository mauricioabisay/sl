<?php
echo <<<FIN
.area_trabajo {
margin: 1em 1em 0em 1em;
display: block;
}

.area_trabajo * {
margin: 1em auto 0;
padding: 2em;
position: static;
}

.area_trabajo a:visited {
color: $obscuro;
}

.area_trabajo a:hover, a:focus {
color: red;
}

.area_trabajo h1, h2, h3, h4, h5, h6{
color: $normal;
}

.area_trabajo p {
text-indent: 1em;
color: #000;
}

.area_trabajo span {
display: inline;
}

.area_trabajo b {
color: $resaltado;
}

.area_trabajo strong{
color: $resaltado;
}

.area_trabajo b {
color: $resaltado;
}

.area_trabajo i {
	
}

.area_trabajo address {
	
}

.area_trabajo ol {
margin: 1em;
position:relative;
}
.area_trabajo ul {
margin: 1em;
position:relative;
}
FIN;
?>