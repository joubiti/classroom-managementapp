<?php 

$output = exec('python pythonscripts/autoemploi.py');
$var1=str_replace("[",'',$output);
$var2=str_replace("]",'',$var1);
$var3=str_replace("'",'',$var2);
$newlink="https://docs.google.com/gview?url=". $var3 ."&embedded=true";

?>