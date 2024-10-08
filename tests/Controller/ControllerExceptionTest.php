<?php

namespace Walnut\Lib\Test\Http\Controller;

use OutOfBoundsException;
use PHPUnit\Framework\TestCase;
use Walnut\Lib\Http\Controller\ControllerException;

final class ControllerExceptionTest extends TestCase {
	public function testOk(): void {
		$this->assertInstanceOf(ControllerException::class,
			ControllerException::withStatus(402));
	}

	public function testOutOfRangeMin(): void {
		$this->expectException(OutOfBoundsException::class);
		ControllerException::withStatus(201);
	}

	public function testOutOfRangeMax(): void {
		$this->expectException(OutOfBoundsException::class);
		ControllerException::withStatus(601);
	}
}
