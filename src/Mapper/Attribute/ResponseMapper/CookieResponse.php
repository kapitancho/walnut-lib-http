<?php

namespace Walnut\Lib\Http\Mapper\Attribute\ResponseMapper;

use Attribute;
use Psr\Http\Message\ResponseInterface;
use Walnut\Lib\Http\Mapper\{ResponseBuilder, ResponseMapper, ResponseRenderer, ViewRenderer};

#[Attribute]
final readonly class CookieResponse implements ResponseMapper {

	public function __construct(private string $cookieName) {}

	public function mapValue(
		mixed $value,
		ResponseBuilder $responseBuilder,
		ResponseRenderer $responseRenderer,
		ViewRenderer $viewRenderer
	): ResponseInterface {
		return $responseBuilder->emptyResponse()
			->withHeader('Set-Cookie', "$this->cookieName=$value");
	}

}