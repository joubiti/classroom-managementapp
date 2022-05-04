<?php
$output = exec('python pythonscripts/webscrape.py');
$var1=str_replace("[",'',$output);
$var2=str_replace("]",'',$var1);
$var3=str_replace("'",'',$var2);
$array = explode (",", $var3);
?>