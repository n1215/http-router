# http-router

[![Latest Stable Version](https://poser.pugx.org/n1215/http-router/v/stable)](https://packagist.org/packages/n1215/http-router)
[![License](https://poser.pugx.org/n1215/http-router/license)](https://packagist.org/packages/n1215/http-router)
[![Build Status](https://scrutinizer-ci.com/g/n1215/http-router/badges/build.png?b=master)](https://scrutinizer-ci.com/g/n1215/http-router/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/n1215/http-router/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/n1215/http-router/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/n1215/http-router/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/n1215/http-router/?branch=master)

A PSR-7 / PSR-15 compatible router interface and a PSR-15 RequestHandler implementation for routing.
This package helps you to create your own http router.


## Class diagram

### RouterInterface
![router](doc/router.png)

### RoutingErrorInterface and RoutingErrorResponderInterface
![routing-error](doc/routing-error.png)

### RoutingHandler
![routing-handler](doc/routing-handler.png)

## Usage
1. Implement RouterInterface as you like. You can use RoutingError and RoutingResult concrete classes.
2. Implement RoutingErrorResponderInterface as you like.
3. Configure to inject them to RoutingHandler.
4. Use RoutingHandler as an implementation of PSR-15 server request handler.


```php
<?php

class YourRouter implements N1215\Http\Router\RouterInterface
{
    public function match(ServerRequestInterface $request) : RoutingResultInterface
    {
        // implement
    }
}

class YourRoutingErrorResponder implements N1215\Http\Router\RoutingErrorResponderInterface
{
    public function respond(RoutingErrorInterface $error): ResponseInterface
    {
        // implement
    }
}

$routingHandler = new N1215\Http\Router\RoutingHandler(
    new YourRouter(),
    new YourRoutingErrorResponder()
);

/** @var \Psr\Http\Message\ServerRequestInterface $request */
/** @var \Psr\Http\Message\ResponseInterface $response */
$response = $routingHandler->handler($request);

```
