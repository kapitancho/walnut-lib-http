<?php

namespace Walnut\Lib\Http\RequestHandler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final readonly class RoutePathFinder implements MiddlewareInterface {

	/**
	 * @param array<string> $availableRoutes
	 * @param string $routeAttributeName
	 */
	public function __construct(
		private array  $availableRoutes,
		private string $routeAttributeName = 'route'
	) {}

	public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
		$path = $request->getRequestTarget();
		foreach ($this->availableRoutes as $availableRoute) {
			if ($availableRoute === '' || str_starts_with($path, $availableRoute)) {
				/** @noinspection CallableParameterUseCaseInTypeContextInspection */
				$request = $request->withAttribute(
					$this->routeAttributeName,
					$availableRoute
				)->withRequestTarget(
					substr(
						$request->getRequestTarget(),
						strlen($availableRoute)
					)
				)->withUri($request->getUri()->withPath(
				'/' . ltrim(
					substr($request->getUri()->getPath(),
					strlen($availableRoute)), '/')
				));
				break;
			}
		}
		return $handler->handle($request);
	}

}
