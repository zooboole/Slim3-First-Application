<?php


	
	// Let's ask PHP to display all errors whenever they
	// occur in our slim code,
	// otherwise Slim will kind of swalow them, it will
	// only show in the command like.
	// Make sure you set this before other codes
	
	// The value mast become `false` before deployment
	ini_set('display_errors', true);




	// Call composer to autoload(make them available)
	// all classes from the the `vendor` folder
	
	// This file is in charge of doing that, and it's
	// located at vendor/autoload.php
	// Your folders structure might be different from mine,
	// make sure your adjust this relatively
	require __DIR__ . '/../vendor/autoload.php';




	// Let's announce to our application that we will be using
	// the Slim application class(`vendor/slim/slim/slim/App.php`) by calling its namespace. We don't need to require it with its
	// full path `vendor/slim/slim/slim/App.php`. Composer autoload
	// has already done that for us up there.
	use Slim\App;





	// We now get a new instance/Object of slim app itself
	// and we save it in a variable we can name `$app`
	// You can name this variable anything
	$app = new App();



	// We add our first route which will respond to the home page
	// request, usually located at `/` or root.
	$app->get('/', function($request, $response, $args){

		// Do anything here, like:
		echo "Welcome to Slim Town!";

		return $response;
		// Then return an HTTP response
	});


	// Once we have the instance of Slim\App we can ask it to start running
	// the application by calling Slim's run() function
	$app->run();
