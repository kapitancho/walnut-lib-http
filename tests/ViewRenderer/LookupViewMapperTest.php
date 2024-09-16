<?php

namespace Walnut\Lib\Test\Http\ViewRenderer;

use PHPUnit\Framework\TestCase;
use Walnut\Lib\Http\ViewRenderer\LookupViewMapper;
use Walnut\Lib\Http\ViewRenderer\ViewTemplateNotFound;

final class LookupViewMapperTest extends TestCase {

	public function testOk(): void {
		$mapper = new LookupViewMapper([self::class => 'my-template']);
		self::assertEquals('my-template', $mapper->findTemplate(self::class));
	}

	public function testError(): void {
		$this->expectException(ViewTemplateNotFound::class);
		$mapper = new LookupViewMapper([self::class => 'my-template']);
		self::assertEquals('my-template', $mapper->findTemplate(\stdClass::class));
	}

}