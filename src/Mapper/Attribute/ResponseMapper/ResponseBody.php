<?php

namespace Walnut\Lib\Http\Mapper\Attribute\ResponseMapper;

use Attribute;
use Psr\Http\Message\ResponseInterface;
use Walnut\Lib\Http\Mapper\{ResponseBuilder, ResponseMapper, ResponseRenderer, ViewRenderer};

#[Attribute]
final readonly class ResponseBody implements ResponseMapper {
	public const CONTENT_TYPE_HTML = 'text/html';

	public function __construct(
		private string $contentType = self::CONTENT_TYPE_HTML
	) {}

	public function mapValue(
		mixed $value,
		ResponseBuilder $responseBuilder,
		ResponseRenderer $responseRenderer,
		ViewRenderer $viewRenderer
	): ResponseInterface {
		return $responseBuilder->textResponse((string)$value)->withHeader(
			ResponseBuilder::CONTENT_TYPE_HEADER, $this->contentType
		);
	}
}