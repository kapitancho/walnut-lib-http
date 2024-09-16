<?php

namespace Walnut\Lib\Http\Mapper\Attribute\RequestMapper;

use Attribute;
use Psr\Http\Message\ServerRequestInterface;
use Walnut\Lib\Http\Mapper\RequestMapper;

#[Attribute]
final readonly class FromAttribute implements RequestMapper {

	public function __construct(private ?string $attributeName = null, private string $defaultValue = '') {}

	public function mapValue(ServerRequestInterface $request, string $argName, array $requestMatchArgs): string {
		return (string)($request->getAttribute($this->attributeName ?? $argName) ?? $this->defaultValue);
	}
}