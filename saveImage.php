<?php

header("Access-Control-Allow-Origin: *");

define('CONTENT_IMAGES', './images_to_send/');

function saveImage($base64img,$name){ 
	$base64img = str_replace('data:image/jpeg;base64,', '', $base64img); 
	$data = base64_decode($base64img); 
	$file = CONTENT_IMAGES . $name.'.jpg'; 
	file_put_contents($file, $data);
}

function generateRandomString($length) { 
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	$charactersLength = strlen($characters);
	$randomString = ''; for ($i = 0; $i < $length; $i++) {
        	$randomString .= $characters[rand(0, $charactersLength - 1)];
    	}
	return $randomString;
}

$base64 = $_POST['base64'];

if($base64 == ""){
	$data["status"]=false;
	$data["message"]='Empty base64 file';
	echo  json_encode( $data );
	die();
}

$name_file = generateRandomString(10);
while(file_exists(CONTENT_IMAGES . $name_file.'.jpg')){
	$name_file = generateRandomString(10);
}

saveImage($base64,$name_file);

$data["name"] = $name_file;
$data["status"] = success;

echo  json_encode( $data );
