
# Workouts with Slim 3 - Part 2: Your first application

--------
> After downloading this, run
>    composer update to get the package to your folder

--------

In this second part of this series we will get in touch with the Slim framework. Today I am going through how to [install](http://phpocean.com/tutorials/back-end/laravel-for-tortoises-part-3-installation-in-toto/26) Slim 3 and write our first code with it. But before that I would like to remember you(beginners) that there some minimum you really need to understand/master before you could feel at home with Slim 3.

* **Read the first part 1 [here](http://phpocean.com/tutorials/back-end/workouts-with-slim-3/42)**

## Pre-requisites

You need to be acquainted to following concepts and technics in PHP:

* Object Oriented Programming(OOP)
* Classes
* Namespaces
* Interfaces
* Composer
* Auto-loading of classes


This also assumes that you have more or less knowledge in php [functions](http://phpocean.com/tutorials/back-end/understand-and-use-functions-in-php-part-2/41), in the [MVC](http://phpocean.com/tutorials/back-end/how-to-start-your-own-php-mvc-framework-in-4-steps/28) design pattern, [routing](http://phpocean.com/tutorials/back-end/laravel-for-tortoises-part-4-routing/27), and a bit of [templating](http://phpocean.com/tutorials/back-end/php-frameworking-templating-part-4/17) concepts.




# Get started

Now let see how exactly we can use Slim. Remember Slim is a simple composer package. So we will be using composer to grab it from the Slim main repository. If you don't have composer please go [here]() and install it based on the type of Operating System([Windows](https://getcomposer.org/doc/00-intro.md#installation-windows), [Linux / Unix / OSX](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)) you are using.

Once you have composer set, create a new folder in your web root and name it `myapp`. Then `cd` to it then run the following code:


    composer require slim/slim "^3.0"


> This command downloads some files(Some five packages). If you have an internet connection(modems) which you cannot use to download(especially most of us in Africa) pay attention.

Which will install the latest Slim into your `myapp` folder. What will be doing is just to test the slim code by displaying a simple feedback(kind of `Hello World`) to our users when they point to our site.

After you've grabbed a copy of slim into your `myapp` folder you should have the following content within it:


    - --- myapp
      - --- vendor/
      - --- composer.json
      - --- composer.lock
     

* The `vendor` folder actually contains the Slim packages and some of its dependencies.
Under the `vendor` folder you will see a sub-folder named `slim`. That's actually `Slim`, It contains all we need.

* The `composer.json` contains the list of packages to grab. Which means even if you delete the `vendor` folder you can still run `composer update` and get it back with the same ppackages like at first.

* The `composer.lock` does almost the same thing as the `composer.json` except it locks the dependencies of your project to a known state. Checkout more about it [here](https://getcomposer.org/doc/01-basic-usage.md#composer-lock-the-lock-file).

Until now nothing really `Slimmy`, what we said is more of composer thing, and I think now you understand why I added it in the pre-requisites.



## Minimalist App with Slim 3

To create our application let's create a new folder in `myapp` and we will name it `public`. This one will contain our `index.php` file. So our folder structure becomes:

    - --- myapp
      - --- vendor/
      - --- composer.json
      - --- composer.lock
      - --- public/
      - --- -- index.php

To preview the application, start your terminal and run the following command:

    cd myapp
    php -S 0.0.0.0:8888 -t public/


The first command moves you the you application folder, and the second runs the PHP in-built server by indicating it the folder(`public`) in which to look start running.

If you are using `XAMP` or any similar package you can also go to `http://localhost/myapp/public/`.


Until here, your application displays **nothing**. it's normal, we have nothing yet in the `index.php`. Let's add the following code in that file. I have well commented each line to make it self-explanatory:

### - public/index.php

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
    
    
    	// Once we have the instance of Slim\App we can ask it to start running
    	// the application by calling Slim's run() function
    	$app->run();
    	

Now try to preview your application again. This time you should get this error:

![Slim Error](http://phpocean.com/assets/images/pics-articles/SLimError.png)

This error is so far normal. After all, remember that Slim handles HTTP requests and returns HTTP responses. Actually our HTTP request is to get the `GET` the `index.php` from our server located at the root of `0.0.0.0`(or `127.0.0.1`) on port `8080` which looks like following:

    GET / HTTP/1.1
    Host: 0.0.0.0:8080
    Connection: keep-alive
    Cache-Control: max-age=0
    Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8
    Upgrade-Insecure-Requests: 1
    User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36
    Accept-Encoding: gzip, deflate, sdch
    Accept-Language: en-US,en;q=0.8

*<small>Sample of HTTP Request message</small>*

You can see that through the HTTP request line:

    GET / HTTP/1.1


And the request Headers:

    Host: 0.0.0.0:8080
    Connection: keep-alive
    Cache-Control: max-age=0
    .....


In response to this request the server sent us this:

![Slim Error](http://phpocean.com/assets/images/pics-articles/Slim404.png)


And the response message looks like:

    HTTP/1.1 404 Not Found
    Host: 0.0.0.0:8080
    Connection: close
    X-Powered-By: PHP/5.5.9-1ubuntu4.14
    Content-Type: text/html
    Content-Length: 877

*<small>Sample of HTTP Response message</small>*



The Response Status line says it all. The page we are looking for is not found, which corresponds the the code `404`.

But in our code we are trying the load the `public/index.php` which file we know exists and has no error in it. So, what coulb possibly had happened?

Now let's go back and see what Slim says about this.

> A Slim app contains **routes** that respond to **specific HTTP requests**. *Each* route invokes a callback and *returns* an **HTTP response**. 


Oh yeah! that's the solution to the problem. Slim needs us to define what is called routes which will be in charge of handling our HTTP request. Slim emphasizes on it by precising that each route awaits a `specific` request. Meaning we must define a particular request for our `home` page, another one for our `about` page, etc.

Now let's add the route to our application and see how it goes. Just add te following after the instance of Slim:


    // ......
    $app = new App();
    
    
    // We add our first route which will respond to the home page
    // request, usually located at `/` or root.
    $app->get('/', function($request, $response, $args){
    
    	// Do anything here, like:
    	echo "Welcome to Slim Town!";
    
    	return $response;
    	// Then return an HTTP response
    });


The final code in the `public/index.php` file will look like:

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
    	



That's an example of a route. Now if you refresh your application you should see:

![Slim Error](http://phpocean.com/assets/images/pics-articles/SlimOK.png)

And the response message looks like this:

![Slim Error](http://phpocean.com/assets/images/pics-articles/Slim200.png)

    HTTP/1.1 200 OK
    Host: 0.0.0.0:8080
    Connection: close
    X-Powered-By: PHP/5.5.9-1ubuntu4.14
    Content-Type: text/html; charset=UTF-8
    Content-Length: 21

## Conclusion

That was the power behind the simplicity of Slim Micro-framework. With this it could just take you some few hours to have a simple website done. In the next part we will be talking more about the routing. Here I have just shown you only one way. Stay tuned, next part is going to make the dance more exiting.

My finale source code is available [here]() or on my [GitHub](https://github.com/zooboole), which you can easily download and compare with the one you got. And if you have any question or something to add, please comment under this tutorial.

If you loved this part, please do not hesitated to share it with friends, I am sure they would love to know about it. Sharing is caring.
