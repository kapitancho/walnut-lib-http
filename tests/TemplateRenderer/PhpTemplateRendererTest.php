<?php

namespace Walnut\Lib\Test\Http\TemplateRenderer;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use Throwable;
use Walnut\Lib\Http\TemplateRenderer\PhpTemplateRenderer;
use Walnut\Lib\Http\TemplateRenderer\TemplateNameMapper;

final class PhpTemplateRendererTest extends TestCase {

	private  function getRenderer(): PhpTemplateRenderer {
		$mapper = new class implements TemplateNameMapper {
			public function fileNameFor(string $key): string {
				return __FILE__ . ".$key";
			}
		};
		return new PhpTemplateRenderer($mapper);
	}

	public function testOk(): void {
		$renderer = $this->getRenderer();
		$this->assertStringContainsString('5', $renderer->render('test', 5));
		$this->assertTrue($renderer->canRenderTemplate('test'));
	}

	public function testTemplateNotFound(): void {
		$this->expectException(Throwable::class);
		$renderer = $this->getRenderer();
		$renderer->render('not-found');
	}

	public function testExceptionThrown(): void {
		$this->expectException(RuntimeException::class);
		$renderer = $this->getRenderer();
		$renderer->render('test', 'throw');
	}

}
