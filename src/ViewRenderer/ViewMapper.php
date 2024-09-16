<?php

namespace Walnut\Lib\Http\ViewRenderer;

interface ViewMapper {
	/**
	 * @param class-string $className
	 * @throws ViewTemplateNotFound
	 */
	public function findTemplate(string $className): string;
}