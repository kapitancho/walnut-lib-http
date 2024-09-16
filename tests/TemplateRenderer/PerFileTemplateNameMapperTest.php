<?php

namespace Walnut\Lib\Test\Http\TemplateRenderer;

use PHPUnit\Framework\TestCase;
use Walnut\Lib\Http\TemplateRenderer\PerFileTemplateNameMapper;

final class PerFileTemplateNameMapperTest extends TestCase {

	public function testOk(): void {
		$mapper = new PerFileTemplateNameMapper('dir', 'php');
		$this->assertEquals('dir/tpl.php', $mapper->fileNameFor('tpl'));
	}

}
