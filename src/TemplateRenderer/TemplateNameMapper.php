<?php

namespace Walnut\Lib\Http\TemplateRenderer;

interface TemplateNameMapper {
	public function fileNameFor(string $key): string;
}