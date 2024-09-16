<?php

namespace Walnut\Lib\Http\Mapper\Attribute\RequestMatch;

use Attribute;

#[Attribute]
final readonly class HttpPut extends RouteMatch {
	public function __construct(string $path = null, int $priority = 0) {
		parent::__construct($path, ['PUT'], $priority);
	}
}