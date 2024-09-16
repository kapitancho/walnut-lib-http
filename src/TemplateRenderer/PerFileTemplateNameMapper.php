<?php

namespace Walnut\Lib\Http\TemplateRenderer;

final readonly class PerFileTemplateNameMapper implements TemplateNameMapper {
	public function __construct(
		private string $baseDir,
		private string $fileExtension = 'php'
	) { }

	public function fileNameFor(string $key): string {
		return "$this->baseDir/$key.$this->fileExtension";
	}
}
