<?php

namespace Walnut\Lib\Http\Mapper\Attribute\ResponseMapper;

use Attribute;
use Psr\Http\Message\ResponseInterface;
use Walnut\Lib\Http\Mapper\{ResponseBuilder, ResponseMapper, ResponseRenderer, ViewRenderer};

#[Attribute]
final readonly class TextResponse implements ResponseMapper {

	public function __construct(public int $statusCode = 200) {}

	public function mapValue(
		mixed $value,
		ResponseBuilder $responseBuilder,
		ResponseRenderer $responseRenderer,
		ViewRenderer $viewRenderer
	): ResponseInterface {
		return $responseBuilder->textResponse($value, $this->statusCode);
	}

}