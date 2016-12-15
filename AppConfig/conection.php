<?php

$host		="localhost";
$user		="root";
$pass		="root";
$database	="demotron";

/*Variable de Conexion*/
$mysqli = new mysqli($host, $user, $pass, $database);
if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}