<?php

namespace Walnut\Lib\Http\Mapper\Attribute\ResponseMapper;

use Attribute;
use Psr\Http\Message\ResponseInterface;
use Walnut\Lib\Http\Mapper\{ResponseBuilder, ResponseMapper, ResponseRenderer, ViewRenderer};

#[Attribute]
final readonly class ContentResponse implements ResponseMapper {

	public function __construct(
		private string $templateName
	) {}

	public function mapValue(
		mixed $value,
		ResponseBuilder $responseBuilder,
		ResponseRenderer $responseRenderer,
		ViewRenderer $viewRenderer
	): ResponseInterface {
		return $responseBuilder->htmlResponse(
			$responseRenderer->render($this->templateName, $value)
		);
	}

}