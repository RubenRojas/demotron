<?php

//Home
$app->get('/', function()  {

	//session_start();

	$language = "PHP";
	$titulo = "";
	if(!isset($_SESSION['id']) or $_SESSION['id']=="NO"){
		
		View::view_noMenu("home", "login", compact("titulo"));
	}
	else{
		View::view("home", "home", compact('language', 'titulo'));	
	}	
});

//about

$app->get('/about', function()  {
	$titulo='About';
	View::view("home", "about", compact('titulo'));
});


