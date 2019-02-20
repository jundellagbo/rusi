<?php 

$str = 'P'."0".'M';
$date = new DateTime("2016-02-01");
$date->add(new DateInterval($str));
echo $date->format('M  Y') . "<br>";