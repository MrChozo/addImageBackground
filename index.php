<?php
// index.php

// Basically a Bash script, but eh.

$dir = './to_convert/';

function add_background()
{
	$unique = rand(0,99999);

	$filename = "employees_" . $unique . "_" . str_replace(" ", "_",basename($_FILES['file']['name']));
	$path = WWW_ROOT . "/img/employees/" . $filename;
	if (move_uploaded_file($_FILES['file']['tmp_name'], $path))
	{
		exec("chmod 777 $path");

		//Create Thumbnail
		$thumb_nail = $path . "_thumb.png";
		$data["filename"] = '/img/employees/' . $filename . "_thumb.png";

		$background = $path . '_back.png';

		// Create white background
		exec("/usr/bin/convert -size 250x250 xc:none $background");

		// Resize image
		exec("/usr/bin/convert $path -resize '250x250>' -background none -flatten $thumb_nail");

		// Combine image onto background
		exec("/usr/bin/composite -gravity center $thumb_nail $background $thumb_nail");

		// Delete background
		exec("rm $background");
	}
	else
	{
		$data["error"] = "Failed to save";
	}
	echo json_encode($data);
	exit;
}



