<?php

namespace Walnut\Lib\Http\Mapper;

interface ResponseRenderer {
	/**
	 * @param string $templateName
	 * @param mixed $viewModel
	 * @return string
	 */
	public function render(string $templateName, mixed $viewModel = null): string;
}
