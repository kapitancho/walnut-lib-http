<?php

namespace Walnut\Lib\Http\RequestHandler;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final readonly class CorsHandler implements MiddlewareInterface {

	/**
	 * @param string[] $origins
	 * @param string[] $methods
	 * @param string[] $allowedHeaders
	 * @param string[] $exposedHeaders
	 */
	public function __construct(
		private ResponseFactoryInterface $responseFactory,
		private array                    $origins = ['*'],
		private array                    $methods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'],
		private array                    $allowedHeaders = [],
		private array                    $exposedHeaders = [],
		private bool                     $allowCredentials = false,
		private int                      $maxAge = 0
	) {}

	public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
		return $this->addHeaders(
			$request->getMethod() === 'OPTIONS' ?
			$this->responseFactory->createResponse() :
			$handler->handle($request)
		);
	}

	/** @noinspection CallableParameterUseCaseInTypeContextInspection */
	private function addHeaders(ResponseInterface $response): ResponseInterface {
		if ($this->allowCredentials) {
			$response = $response->withAddedHeader('Access-Control-Allow-Credentials', 'true');
		}
		if ($this->exposedHeaders) {
			$response = $response->withAddedHeader('Access-Control-Expose-Headers', implode(', ', $this->exposedHeaders));
		}
		if ($this->allowedHeaders) {
			$response = $response->withAddedHeader('Access-Control-Allow-Headers', implode(', ', $this->allowedHeaders));
		}
		if ($this->origins) {
			$response = $response->withAddedHeader('Access-Control-Allow-Origin', implode(', ', $this->origins));
		}
		if ($this->methods) {
			$response = $response->withAddedHeader('Access-Control-Allow-Methods', implode(', ', $this->methods));
		}
		if ($this->maxAge) {
			$response = $response->withAddedHeader('Access-Control-Max-Age', (string)$this->maxAge);
		}
		return $response;
	}

}
