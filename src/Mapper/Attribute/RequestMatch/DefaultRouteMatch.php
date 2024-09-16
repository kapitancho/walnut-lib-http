<?php

namespace Walnut\Lib\Http\Mapper\Attribute\RequestMatch;

use Attribute;
use Psr\Http\Message\ServerRequestInterface;
use Walnut\Lib\Http\Mapper\RequestMatch;

#[Attribute]
final readonly class DefaultRouteMatch implements RequestMatch {
	public function matches(ServerRequestInterface $request): array {
		return [];
	}

	public function getMatchPriority(): int {
		return PHP_INT_MIN;
	}
}