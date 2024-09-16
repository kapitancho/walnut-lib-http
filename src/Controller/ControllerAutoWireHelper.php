<?php

namespace Walnut\Lib\Http\Controller;

use Psr\Http\Server\RequestHandlerInterface;
use Walnut\Lib\Data\Hydrator\ClassHydrator;
use Walnut\Lib\Http\Mapper\ResponseBuilder;
use Walnut\Lib\Http\Mapper\ResponseRenderer;
use Walnut\Lib\Http\Mapper\ViewRenderer;

final readonly class ControllerAutoWireHelper implements ControllerHelper {

	public function __construct(
		private ClassHydrator    $classHydrator,
		private ResponseBuilder  $responseBuilder,
		private ResponseRenderer $responseRenderer,
		private ViewRenderer     $viewRenderer,
	) {}

	public function wire(object $targetController): RequestHandlerInterface {
		return new AutoWireRequestHandler(
			new ReflectionControllerParser($this->classHydrator, $targetController),
			$this->responseBuilder,
			$this->responseRenderer,
			$this->viewRenderer
		);
	}

}