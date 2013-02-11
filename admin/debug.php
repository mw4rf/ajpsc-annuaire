<?php


$date[1] = "2000-12-01";
$date[2] = "19/03/1984";



$pattern     = "`([0-9]{4})-([0-9]{2})-([0-9]{2})`";
$replacement = "$3/$2/$1";

//$pattern     = "`([0-9]{2})/([0-9]{2})/([0-9]{4})`"; // JJ/MM/AAAA
//$replacement = "$3-$2-$1";

foreach($date as $k=>$v)
echo "$v => ".preg_replace($pattern, $replacement, $v)."<br />";







?>