<?php

namespace Walnut\Lib\Http\Mapper;

use Psr\Http\Message\ResponseInterface;

interface ResponseMapper {
	public function mapValue(
		mixed $value,
		ResponseBuilder $responseBuilder,
		ResponseRenderer $responseRenderer,
		ViewRenderer $viewRenderer
	): ResponseInterface;
}