<?php

/* JPEGCam Test Script */
/* Receives JPEG webcam submission and saves to local file. */
/* Make sure your directory has permission to write files as your web server user! */
$pic = "Remedio-".date("Ymd-His")."-1516";
$filename = $pic. '.jpg';
$result = file_put_contents( 'student_photo/'.$filename, file_get_contents('php://input') );
if (!$result) {
	echo "ERROR: Failed to write data to $filename, check permissions\n";
	exit();
}

	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/student_photo/' . $filename;
	echo "$url\n";

?>
