<?php

namespace Walnut\Lib\Http\Mapper\Attribute\RequestMapper;

use Attribute;
use Psr\Http\Message\ServerRequestInterface;
use Walnut\Lib\Http\Mapper\RequestMapper;

#[Attribute]
final readonly class FromRouteParams implements RequestMapper {

	public function mapValue(ServerRequestInterface $request, string $argName, array $requestMatchArgs): array {
		return $requestMatchArgs;
	}
}