<?php

namespace Walnut\Lib\Http\Mapper\Attribute\RequestMapper;

use Attribute;
use Psr\Http\Message\ServerRequestInterface;
use Walnut\Lib\Http\Mapper\RequestMapper;

#[Attribute]
final readonly class FromQuery implements RequestMapper {

	public function __construct(private ?string $queryVar = null, private string $defaultValue = '') {}

	public function mapValue(ServerRequestInterface $request, string $argName, array $requestMatchArgs): string {
		return (string)($request->getQueryParams()[$this->queryVar ?? $argName] ?? $this->defaultValue);
	}
}