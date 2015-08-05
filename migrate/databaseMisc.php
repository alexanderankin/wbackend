<?php 
include 'rb.php';
R::setup('mysql:host=localhost; dbname=wbackend','root', 'toor');

function playlist()
{
	$playlist = R::load('playlists', 1);
	foreach ($playlist->sharedSongsList as $key => $song) {
		echo "\n\n\t iterating:\t: ".$song->title."\n";
	}
}

/**
 * make control availible to robo
 */
switch (strtolower(end($argv))) {
	case 'playlist':
	case 'pl':
	case 'pls':
		playlist();
		break;
	default:
		# code...
		break;
}
