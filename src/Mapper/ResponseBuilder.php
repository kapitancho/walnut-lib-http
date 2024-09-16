<?php

namespace Walnut\Lib\Http\Mapper;

use Psr\Http\Message\ResponseInterface;

interface ResponseBuilder {
	public const CONTENT_TYPE_HEADER = 'Content-Type';
	public const CONTENT_TYPE_JSON = 'application/json';
	public const CONTENT_TYPE_HTML = 'text/html';
	public const CONTENT_TYPE_TEXT = 'text/plain';

	public function emptyResponse(int $code = 200): ResponseInterface;
	public function contentResponse(string $content, int $code = 200): ResponseInterface;
	public function textResponse(string $text, int $code = 200): ResponseInterface;
	public function jsonResponse(mixed $value, int $code = 200): ResponseInterface;
	public function htmlResponse(string $html, int $code = 200): ResponseInterface;

}