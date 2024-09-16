<?php

namespace Walnut\Lib\Http\TemplateRenderer;

use RuntimeException;
use Throwable;

final readonly class PhpTemplateRenderer implements TemplateRenderer {

	public function __construct(
		private TemplateNameMapper $templateNameMapper
	) {}

	public function canRenderTemplate(string $templateName): bool {
		return is_file($this->templateNameMapper->fileNameFor($templateName));
	}

	public function render(string $templateName, mixed $viewModel = null): string {
		$filePath = $this->templateNameMapper->fileNameFor($templateName);
		if (!is_file($filePath)) {
			throw new RuntimeException("Template $templateName not found ($filePath not found)");
		}
		ob_start();
		try {
			include $filePath;
		} catch (Throwable $ex) {
			ob_end_clean();
			throw $ex;
		}
		return ob_get_clean() ?: '';
	}
}