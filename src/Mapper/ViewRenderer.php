<?php

namespace Walnut\Lib\Http\Mapper;

interface ViewRenderer {
	/**
	 * @param mixed $view
	 * @return string
	 */
	public function render(object $view): string;
}
