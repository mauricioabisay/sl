<?php
echo <<<FIN
.menu {
width: 95%;
text-align: center;
position: relative;
margin: 0em 0em 1em 0em;
padding: 1em;
display: block;
}

.menu ul{
text-align: left;
}

.menu ul li {
list-style-type: none;
float: left;
margin-right:0.2em;
}

.menu ul li a {
color: #fff;
font-size: 90%;
text-decoration: none;
color: #fff;
background-color: $normal;
border: 1px solid $obscuro;
padding: 5px;
}

.menu ul li a:hover, a:focus {
color: #fff;
background-color: $resaltado;
}

.menu ul li ul{
display: none;
position: relative;
float: none;
padding: 0;
margin-top: 0.4em;
}

.menu ul li ul li{
color: #fff;
font-size: 80%;
display: block;
float: none;
text-decoration: none;
background-color: $normal;
border: 1px solid $obscuro;
padding: 5px;
margin-top: 0.2em;
margin-bottom: 0.2em;
}

.menu ul li ul li:hover{
color: #fff;
background-color: $resaltado;
}

.menu ul li ul li a{
color: #fff;
background-color: none;
border: 0px;
padding: 5px;
}

.menu ul li ul li a:hover, a:focus{
color: #fff;
background-color: transparent;
}

.menu ul .inactivo {
color: #B2B2B2;
background-color: $claro;
border: 0px;
}

.menu ul .inactivo:hover {
color: #B2B2B2;
background-color: $claro;
border: 0px;
}

.menu ul .inactivo a{
color: #B2B2B2;
pointer-events: none;
cursor: default;
background-color: $claro;
border: 0px;
}

.menu ul .seleccionado {
color: $claro;
background-color: $resaltado;
border: 0px;
}

.menu ul .seleccionado:hover {
color: $claro;
background-color: $resaltado;
border: 0px;
}

.menu ul .seleccionado a{
color: $claro;
background-color: $resaltado;
border: 0px;
}
FIN;
?>