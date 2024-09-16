<?php

namespace Walnut\Lib\Http\RequestHandler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final readonly class CompositeHandler implements RequestHandlerInterface {
	/**
	 * @param RequestHandlerInterface $defaultHandler
	 * @param MiddlewareInterface[] $middlewares
	 */
	public function __construct(
		private RequestHandlerInterface $defaultHandler,
		private array                   $middlewares
	) {}

	public function handle(ServerRequestInterface $request): ResponseInterface {
		if (!$this->middlewares) {
			return $this->defaultHandler->handle($request);
		}
		$middleware = $this->middlewares[0];
		return $middleware->process($request, new self(
			$this->defaultHandler, array_slice($this->middlewares, 1)
		));
	}
}
