<?php

namespace Walnut\Lib\Http\Mapper;

use Psr\Http\Message\ServerRequestInterface;

interface RequestMapper {
	/**
	 * @param ServerRequestInterface $request
	 * @param string $argName
	 * @param array $requestMatchArgs
	 * @return array|object|int|string|float|bool|null
	 */
	public function mapValue(ServerRequestInterface $request, string $argName, array $requestMatchArgs):
		array|object|int|string|float|bool|null;
}