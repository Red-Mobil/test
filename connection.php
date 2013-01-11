<?php

$connection_string="host=localhost port=5432 user=postgres password=123 dbname=postgres";
$conn = pg_connect($connection_string) or die("Falló la conexión.");

?>