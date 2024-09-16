<?php

namespace Walnut\Lib\Http\RequestHandler;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final readonly class NotFoundHandler implements RequestHandlerInterface {

	public function __construct(
		private ResponseFactoryInterface $responseFactory,
	) {}

	public function handle(ServerRequestInterface $request): ResponseInterface {
		return $this->responseFactory->createResponse(404);
	}
}
