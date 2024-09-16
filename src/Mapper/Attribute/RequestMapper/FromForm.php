<?php

namespace Walnut\Lib\Http\Mapper\Attribute\RequestMapper;

use Attribute;
use Psr\Http\Message\ServerRequestInterface;
use Walnut\Lib\Http\Mapper\RequestMapper;

#[Attribute]
final readonly class FromForm implements RequestMapper {

	public function __construct(
		private ?string      $formVar = null,
		private string|array $defaultValue = ''
	) {}

	public function mapValue(ServerRequestInterface $request, string $argName, array $requestMatchArgs): string|array {
		$result = (((array)$request->getParsedBody())[$this->formVar ?? $argName] ?? $this->defaultValue);
		if (!is_array($result)) {
			$result = (string)$result;
		}
		return $result;
	}
}