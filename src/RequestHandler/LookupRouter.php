<?php

namespace Walnut\Lib\Http\RequestHandler;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Walnut\Lib\Http\Controller\ControllerHelper;

final readonly class LookupRouter implements MiddlewareInterface {

	/**
	 * @param ControllerHelper $controllerHelper
	 * @param ContainerInterface $container
	 * @param array<string, class-string> $routerMapping
	 * @param string $routeAttributeName
	 */
	public function __construct(
		private ControllerHelper   $controllerHelper,
		private ContainerInterface $container,
		private array              $routerMapping,
		private string             $routeAttributeName = 'route'
	) {}

	public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
		$route = (string)$request->getAttribute($this->routeAttributeName);
		$routeHandler = $this->routerMapping[$route] ?? null;
		/**
		 * @var RequestHandlerInterface|object $mappedHandler
		 */
		$mappedHandler = $routeHandler ? $this->container->get($routeHandler) : $handler;

		$next = $mappedHandler instanceof RequestHandlerInterface ?
			$mappedHandler : $this->controllerHelper->wire($mappedHandler);

		return $next->handle($request);
	}

}
