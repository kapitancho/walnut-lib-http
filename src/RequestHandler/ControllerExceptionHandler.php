<?php

namespace Walnut\Lib\Http\RequestHandler;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Walnut\Lib\Http\Controller\ControllerException;
use Walnut\Lib\JsonSerializer\JsonSerializer;

final readonly class ControllerExceptionHandler implements MiddlewareInterface {

	public function __construct(
		private JsonSerializer           $jsonSerializer,
		private ResponseFactoryInterface $responseFactory,
		private StreamFactoryInterface   $streamFactory
	) {}

	public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
		try {
			return $handler->handle($request);
		} catch (ControllerException $e) {
			return $this->responseFactory->createResponse($e->getCode())
				->withHeader('Content-Type', 'application/json')
				->withBody($this->streamFactory->createStream(
					$this->jsonSerializer->encode(['error' => $e->getMessage()])
				));
		}
	}
}
