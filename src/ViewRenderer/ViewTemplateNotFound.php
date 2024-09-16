<?php

namespace Walnut\Lib\Http\ViewRenderer;

use RuntimeException;

final class ViewTemplateNotFound extends RuntimeException {
	private const ERROR_MESSAGE = "Template for view %s not found";

	public function __construct(string $className) {
		parent::__construct(sprintf(self::ERROR_MESSAGE, $className));
	}
}