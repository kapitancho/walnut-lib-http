<?php

namespace Walnut\Lib\Http\Mapper\Attribute\ResponseMapper;

use Attribute;
use Psr\Http\Message\ResponseInterface;
use Walnut\Lib\Http\Mapper\{ResponseBuilder, ResponseMapper, ResponseRenderer, ViewRenderer};

#[Attribute]
final readonly class RedirectResponse implements ResponseMapper {
	public function mapValue(
		mixed $value,
		ResponseBuilder $responseBuilder,
		ResponseRenderer $responseRenderer,
		ViewRenderer $viewRenderer
	): ResponseInterface {
		return $responseBuilder->emptyResponse(201)
			->withHeader('Location', (string)$value);
	}

}