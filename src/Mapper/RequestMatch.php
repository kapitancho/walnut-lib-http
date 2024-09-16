<?php

namespace Walnut\Lib\Http\Mapper;

use Psr\Http\Message\ServerRequestInterface;

interface RequestMatch {
	/**
	 * @param ServerRequestInterface $request
	 * @return string[]|null
	 */
	public function matches(ServerRequestInterface $request): ?array;

	/**
	 * @return int
	 */
	public function getMatchPriority(): int;
}