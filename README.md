# http-router

[![Latest Stable Version](https://poser.pugx.org/n1215/http-router/v/stable)](https://packagist.org/packages/n1215/http-router)
[![License](https://poser.pugx.org/n1215/http-router/license)](https://packagist.org/packages/n1215/http-router)
[![Build Status](https://scrutinizer-ci.com/g/n1215/http-router/badges/build.png?b=master)](https://scrutinizer-ci.com/g/n1215/http-router/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/n1215/http-router/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/n1215/http-router/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/n1215/http-router/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/n1215/http-router/?branch=master)

A PSR-7 / PSR-15 compatible router interface and a PSR-15 server request handler implementation for routing.

This package helps you to create your own http router.

## Usage

```php
<?php

// 1. Implement RouterInterface. You can use RoutingError and RoutingResult concrete classes.
class YourRouter implements N1215\Http\Router\RouterInterface
{
    public function match(ServerRequestInterface $request) : RoutingResultInterface
    {
        // implement
    }
}

// 2. Implement RoutingErrorResponderInterface.
class YourRoutingErrorResponder implements N1215\Http\Router\RoutingErrorResponderInterface
{
    public function respond(RoutingErrorInterface $error): ResponseInterface
    {
        // implement
    }
}

// 3. Configure to inject them into RoutingHandler.
$routingHandler = new N1215\Http\Router\RoutingHandler(
    new YourRouter(),
    new YourRoutingErrorResponder()
);


// 4. Use RoutingHandler as an implementation of PSR-15 server request handler.
/** @var \Psr\Http\Message\ServerRequestInterface $request */
/** @var \Psr\Http\Message\ResponseInterface $response */
$response = $routingHandler->handle($request);

```

## Class diagrams

### RouterInterface
![router](doc/router.png)

### RoutingErrorInterface and RoutingErrorResponderInterface
![routing-error](doc/routing-error.png)

### RoutingHandler
![routing-handler](doc/routing-handler.png)
