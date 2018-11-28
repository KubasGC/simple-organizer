<?php
$MySQL = new mysqli("mysql01int.az.pl", "u1051070_lso", "Nn7dIB?9N(", "db1051070_lso");
$connectionSuccess = true;

if ($MySQL->connect_error) $connectionSuccess = false;
else {
    $MySQL->query("SET NAMES UTF8");
    $MySQL->query("SET CHARACTER SET UTF8");
}

?>