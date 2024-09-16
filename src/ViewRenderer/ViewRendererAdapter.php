<?php

namespace Walnut\Lib\Http\ViewRenderer;

use Walnut\Lib\Http\Mapper\ViewRenderer;
use Walnut\Lib\Http\TemplateRenderer\TemplateRenderer;

final readonly class ViewRendererAdapter implements ViewRenderer {
	public function __construct(
		private TemplateRenderer $templateRenderer,
		private ViewMapper       $viewMapper,
	) {}

	public function render(object $view): string {
		return $this->templateRenderer->render(
			$this->viewMapper->findTemplate($view::class),
			$view
		);
	}
}