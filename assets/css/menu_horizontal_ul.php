<?php
echo <<<FIN
.menu {
width: 90%;
text-align: center;
position: relative;
margin: 0em 0em 1em 0em;
padding: 1em;
display: block;
}

.menu ul{
margin-top: 0.2em;
text-align: center;
}

.menu ul li {
list-style-type: none;
float: left;
}

.menu ul li a {
color: #fff;
font-size: 95%;
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

.menu ul li ul {
display: none;
width:inherit;
position: relative;
float: none;
padding: 0;
}

.menu ul li:hover ul {
display: block;
}

.menu ul li ul li {
font-size:80%;
display: block;
float: none;
color: #000;
margin-top: 0.8em;
margin-bottom: 0.8em;
}
FIN;
?>