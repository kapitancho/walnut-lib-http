<?php

namespace Walnut\Lib\Http\ViewRenderer;

final readonly class LookupViewMapper implements ViewMapper {

	/** @param array<class-string, string> $mapping */
	public function __construct(
		private array $mapping
	) {}

	/**
	 * @param class-string $className
	 * @throws ViewTemplateNotFound
	 */
	public function findTemplate(string $className): string {
		return $this->mapping[$className] ?? throw new ViewTemplateNotFound($className);
	}

}