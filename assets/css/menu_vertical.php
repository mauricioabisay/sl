<?php
echo <<<FIN
.menu {
width: 10%;
text-align: center;
position: relative;
margin: 0em;
padding: 0em;
display: block;
}

.menu ul{

}

.menu ul li {
width: 100%;
text-align: center;
list-style-type: none;
float: none;
margin: 0.1em;
}

.menu ul li a {
width: 96%;
color: #fff;
font-size: 95%;
text-decoration: none;
background-color: $normal;
border: 1px solid $obscuro;
color: #fff;
padding: 5px;
display:block;
}

.menu ul li a:hover, a:focus {
color: #fff;
background-color: $resaltado;
}

.menu ul li ul {
display: block; 
position: absolute;
float: none;
padding: 0;
margin-top: 0em;
margin-bottom: 0em;
}

.menu ul li a:hover,a:focus ul {
display: block;
}

.menu ul li ul li {
display: block;
float: none;
color: #000;
margin-top: 1em;
margin-bottom: 1em;
}
FIN;
?>