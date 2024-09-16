<?php

namespace Walnut\Lib\Http\Mapper\Attribute\RequestMapper;

use Attribute;
use JsonException;
use Psr\Http\Message\ServerRequestInterface;
use Walnut\Lib\Http\Mapper\InvalidJsonBody;
use Walnut\Lib\Http\Mapper\RequestMapper;

#[Attribute]
final readonly class FromJsonBody implements RequestMapper {

	/** @throws InvalidJsonBody */
	public function mapValue(
		ServerRequestInterface $request,
		string $argName,
		array $requestMatchArgs
	): array|object|int|string|float|bool|null {
		try {
			/**
			 * @var array|object|int|string|float|bool|null
			 */
			return json_decode(
				$request->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR
			);
		} catch (JsonException $ex) {
			throw new InvalidJsonBody($ex);
		}
	}
}