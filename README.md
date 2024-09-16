# Http Toolkit

TODO

## Example
```php
$requestHandler = new CompositeHandler(
    $notFoundHandler, [
        $noCacheHandler,
        $corsHandler,
        $requestLogger,
        $uncaughtExceptionHandler,
        $controllerExceptionHandler,
        $routePathFinder,
        $lookupRouter
    ]
);
$response = $requestLogger->handle($request);
```