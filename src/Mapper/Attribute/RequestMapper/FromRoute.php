<?php

namespace Walnut\Lib\Http\Mapper\Attribute\RequestMapper;

use Attribute;
use Psr\Http\Message\ServerRequestInterface;
use Walnut\Lib\Http\Mapper\RequestMapper;

#[Attribute]
final readonly class FromRoute implements RequestMapper {

	public function __construct(private ?string $routeArg = null, private string $defaultValue = '') {}

	public function mapValue(ServerRequestInterface $request, string $argName, array $requestMatchArgs): string {
		return (string)($requestMatchArgs[$this->routeArg ?? $argName] ?? $this->defaultValue);
	}
}