<?php
// index.php

// Repurposing Imagemagick code I used in another work thing.
// Basically a Bash script, but eh.
// Run in parent directory, ~/ in my case.
// Also assumes all files have extension .jpg

$dir = './to_convert/';
$target = './converted/';
$color = '1c2d3d';
$height = '600'; // height in px
$width = '950'; // width in px
$filenames = array("Picture29.jpg", "Picture30.jpg", "Picture31.jpg", "Picture1.jpg", "Picture2.jpg", "Picture3.jpg", "Picture4.jpg", "Picture5.jpg", "Picture6.jpg", "Picture7.jpg", "Picture8.jpg", "Picture9.jpg", "Picture10.jpg", "Picture11.jpg", "Picture12.jpg", "Picture13.jpg", "Picture14.jpg", "Picture15.jpg", "Picture16.jpg", "Picture17.jpg", "Picture18.jpg", "Picture19.jpg", "Picture20.jpg", "Picture21.jpg", "Picture22.jpg", "Picture23.jpg", "Picture24.jpg", "Picture25.jpg", "Picture26.jpg", "Picture27.jpg", "Picture28.jpg"); // Hurk.

// Check that source image file exists
function verify_file($name) {
	$testPath = $dir . $name;
	if (!file_exists($testPath)) {
		echo "File doesn't exist: '".$testPath."'.";
		exit;
	}
}

// Resize image to appropriate height, maintaining aspect ratio
// Save in target directory
function resize($name) {
	$in = $dir.$name;
	$out = $target.$name;
	exec("/usr/bin/convert -geometry x$height $in $out");
}

// Create solid background, then composite image onto it
function add_background($name) {
	$path = $target.$name;

	// Add crappy suffix for background creation
	$background = $path.'_back.jpg';

	// Create background
	exec("/usr/bin/convert -size $width"."x$height xc:$color $background");

	// Composite image onto background
	exec("/usr/bin/composite -gravity center $path $background $path");

	// Delete background
	exec("rm $background");

	echo "Background added to: '".$name."'.";
}


// main
foreach ($filenames as $name) {
	verify_file($name);

	resize($name);

	add_background($name);

	echo "Completed successfully";
	exit;
}
