<?php

namespace Walnut\Lib\Test\Http\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Server\RequestHandlerInterface;
use Walnut\Lib\Data\Hydrator\ClassHydrator;
use Walnut\Lib\Http\Controller\ControllerAutoWireHelper;
use Walnut\Lib\Http\Mapper\ResponseBuilder;
use Walnut\Lib\Http\Mapper\ResponseRenderer;
use Walnut\Lib\Http\Mapper\ViewRenderer;

final class ControllerAutoWireHelperTest extends TestCase {
	public function testOk(): void {
		$this->assertInstanceOf(RequestHandlerInterface::class,
			(new ControllerAutoWireHelper(
				$this->createMock(ClassHydrator::class),
				$this->createMock(ResponseBuilder::class),
				$this->createMock(ResponseRenderer::class),
				$this->createMock(ViewRenderer::class),
			))->wire($this));
	}
}
