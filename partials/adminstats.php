<?php 
$logretrieve="SELECT type,status,DATE_TRUNC('second', timestamp) from logs ORDER BY timestamp DESC";
$logr1=pg_query($logretrieve);
$query="SELECT * from students";
$result=pg_query($query);
$rows=pg_num_rows($result);
$query2="SELECT * from users";
$result2=pg_query($query2);
$rows2=pg_num_rows($result2);
$query3="SELECT * from prof";
$result3=pg_query($query3);
$rows3=pg_num_rows($result3);
$query4="SELECT * from notif";
$result4=pg_query($query4);
$rows4=pg_num_rows($result4);
$query5="SELECT * from module";
$result5=pg_query($query5);
?>