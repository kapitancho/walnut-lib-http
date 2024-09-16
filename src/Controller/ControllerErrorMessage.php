<?php

namespace Walnut\Lib\Http\Controller;

use OutOfBoundsException;

final readonly class ControllerErrorMessage {
	public function __construct(public int $httpStatusCode, public ?string $message = null) {
		if ($httpStatusCode < 400 || $httpStatusCode >= 600) {
			throw new OutOfBoundsException("Invalid status code: $httpStatusCode");
		}
	}
}