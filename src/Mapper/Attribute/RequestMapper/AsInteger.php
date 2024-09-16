<?php

namespace Walnut\Lib\Http\Mapper\Attribute\RequestMapper;

use Attribute;
use Psr\Http\Message\ServerRequestInterface;
use Walnut\Lib\Http\Mapper\RequestMapper;

#[Attribute]
final readonly class AsInteger implements RequestMapper {
	public function __construct(private RequestMapper $requestMapper) {}

	public function mapValue(ServerRequestInterface $request, string $argName, array $requestMatchArgs): int {
		return (int)$this->requestMapper->mapValue($request, $argName, $requestMatchArgs);
	}
}