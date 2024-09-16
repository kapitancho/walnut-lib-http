<?php

namespace Walnut\Lib\Http\TemplateRenderer;

interface TemplateRenderer {
	public function canRenderTemplate(string $templateName): bool;
	public function render(string $templateName, mixed $viewModel = null): string;
}
