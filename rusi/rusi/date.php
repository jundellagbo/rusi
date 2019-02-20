<?php

// @link http://www.php.net/manual/en/class.datetime.php
$d1 = new DateTime('2016-03-08');
$d2 = new DateTime('2016-04-07');

// @link http://www.php.net/manual/en/class.dateinterval.php
$interval = $d2->diff($d1);

echo $interval->format('%m months');