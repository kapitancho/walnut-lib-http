<?php

namespace Walnut\Lib\Http\Mapper\Attribute;

use Attribute;

#[Attribute]
final readonly class ErrorHandler {
	/**
	 * @param class-string $className
	 */
	public function __construct(public string $className) {}
}