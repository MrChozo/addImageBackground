<?php
// index.php

// Repurposing Imagemagick code I used in another work thing.
// Basically a Bash script, but eh.
// Run in parent directory, ~/ in my case.

$dir = './to_convert/';
$target = './converted/';
$color = '1c2d3d';
$height = '600'; // height in px

$filenames = array("Picture29.jpg", "Picture30.jpg", "Picture31.png", "Picture1.jpg", "Picture2.jpg", "Picture3.jpg", "Picture4.jpg", "Picture5.jpg", "Picture6.jpg", "Picture7.jpg", "Picture8.jpg", "Picture9.jpg", "Picture10.jpg", "Picture11.jpg", "Picture12.jpg", "Picture13.jpg", "Picture14.jpg", "Picture15.jpg", "Picture16.jpg", "Picture17.jpg", "Picture18.jpg", "Picture19.jpg", "Picture20.jpg", "Picture21.jpg", "Picture22.jpg", "Picture23.jpg", "Picture24.jpg", "Picture25.jpg", "Picture26.jpg", "Picture27.jpg", "Picture28.jpg"); // Hurk.


function verify_file_exists($name) {
	$testPath = $dir . $name;
	if (!file_exists($testPath)) {
		echo "File doesn't exist: '".$testPath."'.";
		exit;
	}
}

function add_background($name, $color) {
	$path = $target.$name;

	//Create Thumbnail
	$thumb_nail = $path . "_thumb.png";

	$background = $path . '_back.png';

	// Create white background
	exec("/usr/bin/convert -size 250x250 xc:$color $background");

	// Resize image
	exec("/usr/bin/convert $path -resize '250x250>' -background none -flatten $thumb_nail");

	// Combine image onto background
	exec("/usr/bin/composite -gravity center $thumb_nail $background $thumb_nail");



	echo "Background added to: '".$name."'.";
}

// Resize image to appropriate height
function resize($name, $height) {
	exec("/usr/bin/convert -geometry x$height $in $out");
}

// main
foreach ($filenames as $name) {
	verify_file_exists($name);

	resize($name, $height);

	add_background($name, $color);

	echo "Completed successfully";
	exit;
}
