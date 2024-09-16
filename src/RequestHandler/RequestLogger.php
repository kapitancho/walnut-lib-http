<?php

namespace Walnut\Lib\Http\RequestHandler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

final readonly class RequestLogger implements MiddlewareInterface {

	public function __construct(
		private LoggerInterface $logger
	) {}

	public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
		$this->logger->info("Http Request: " . $request->getMethod() . " / " . $request->getRequestTarget() .
			" / route: " . ((string)$request->getAttribute('route') ?: '[empty]'));
		$response = $handler->handle($request);
		$this->logger->info("Http Response: " . $response->getStatusCode());
		return $response;
	}
}
