<?php

namespace Walnut\Lib\Http\Mapper;

use JsonException;
use RuntimeException;

final class InvalidJsonBody extends RuntimeException {
	public function __construct(JsonException $ex) {
		parent::__construct($ex->getMessage(), $ex->getCode(), $ex->getPrevious());
	}
}