<?php

namespace Walnut\Lib\Http\Mapper\Attribute\RequestMapper;

use Attribute;
use Psr\Http\Message\ServerRequestInterface;
use Walnut\Lib\Http\Mapper\RequestMapper;

#[Attribute]
final readonly class AsObject implements RequestMapper {
	public function __construct(private RequestMapper $requestMapper) {}

	public function mapValue(ServerRequestInterface $request, string $argName, array $requestMatchArgs): object {
		return (object)$this->requestMapper->mapValue($request, $argName, $requestMatchArgs);
	}
}