<?php

namespace Walnut\Lib\Http\Controller;

use Psr\Http\Server\RequestHandlerInterface;

interface ControllerHelper {
	public function wire(object $targetController): RequestHandlerInterface;
}