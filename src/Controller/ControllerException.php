<?php

namespace Walnut\Lib\Http\Controller;

use OutOfBoundsException;
use RuntimeException;

final class ControllerException extends RuntimeException {

	private function __construct(string $message, int $code) {
		parent::__construct($message, $code);
	}

	public static function withStatus(int $httpStatusCode, string $errorMessage = null): self {
		if ($httpStatusCode < 400 || $httpStatusCode >= 600) {
			throw new OutOfBoundsException("Invalid status code: $httpStatusCode");
		}
		return new self($errorMessage ?? "", $httpStatusCode);
	}

}