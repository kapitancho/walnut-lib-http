<?php

namespace Walnut\Lib\Http\Mapper\Attribute\RequestMapper;

use Attribute;
use Psr\Http\Message\ServerRequestInterface;
use Walnut\Lib\Http\Mapper\RequestMapper;

/**
 * @template T of string|float|int|bool|null|array|object
 */
#[Attribute]
final readonly class RawValue implements RequestMapper {
	/**
	 * @param T $value
	 */
	public function __construct(private string|float|int|bool|null|array|object $value) {}

	/** @return T */
	public function mapValue(ServerRequestInterface $request, string $argName, array $requestMatchArgs): string|float|int|bool|array|object|null {
		return $this->value;
	}
}