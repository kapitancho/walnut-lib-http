<?php

namespace Walnut\Lib\Test\Http\Controller;

use OutOfBoundsException;
use PHPUnit\Framework\TestCase;
use Walnut\Lib\Http\Controller\ControllerErrorMessage;

final class ControllerErrorMessageTest extends TestCase {
	public function testOk(): void {
		$this->assertInstanceOf(ControllerErrorMessage::class,
			new ControllerErrorMessage(402));
	}

	public function testOutOfRangeMin(): void {
		$this->expectException(OutOfBoundsException::class);
		$this->assertInstanceOf(ControllerErrorMessage::class,
			new ControllerErrorMessage(201));
	}

	public function testOutOfRangeMax(): void {
		$this->expectException(OutOfBoundsException::class);
		$this->assertInstanceOf(ControllerErrorMessage::class,
			new ControllerErrorMessage(601));
	}
}
