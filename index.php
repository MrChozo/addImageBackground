<?php
// index.php

// Repurposing Imagemagick code I used in another work thing.
// Basically a Bash script, but eh.

$dir = './to_convert/';
$target = './converted/';

$filenames = array("Picture29.jpg", "Picture30.jpg", "Picture31.png", "Picture1.jpg", "Picture2.jpg", "Picture3.jpg", "Picture4.jpg", "Picture5.jpg", "Picture6.jpg", "Picture7.jpg", "Picture8.jpg", "Picture9.jpg", "Picture10.jpg", "Picture11.jpg", "Picture12.jpg", "Picture13.jpg", "Picture14.jpg", "Picture15.jpg", "Picture16.jpg", "Picture17.jpg", "Picture18.jpg", "Picture19.jpg", "Picture20.jpg", "Picture21.jpg", "Picture22.jpg", "Picture23.jpg", "Picture24.jpg", "Picture25.jpg", "Picture26.jpg", "Picture27.jpg", "Picture28.jpg"); // Hurk.


function verify_file_exists($name) {
	$test_path = $dir . $name;
	$target_path = $target . $name;
	if (!move_uploaded_file($test_path, $target_path)) {
		echo "Failed to save";
		exit;
	}
}

function add_background() {
	$unique = rand(0,99999);

	$filename = "employees_" . $unique . "_" . str_replace(" ", "_",basename($_FILES['file']['name']));
	$path = WWW_ROOT . "/img/employees/" . $filename;
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

	echo json_encode($data);
	exit;
}

// main
foreach ($filenames as $name) {
	verify_file_exists($name);

	add_background($name);

	echo "Completed successfully";
	exit;
}
