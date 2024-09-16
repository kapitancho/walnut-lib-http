<?php

namespace Walnut\Lib\Http\Mapper\Attribute\RequestMatch;

use Attribute;
use Psr\Http\Message\ServerRequestInterface;
use Walnut\Lib\Http\Mapper\RequestMatch;

#[Attribute]
readonly class RouteMatch implements RequestMatch {

	private const ROUTE_PATTERN_MATCH = '#\{([\w\_]+)\}#';
	private const ROUTE_PATTERN_REPLACE = '#\{[\w\_]+\}#';
	private const REPLACE_PATTERN = '(.+?)';

	private ?string $path;
	/**
	 * @var string[]|null
	 */
	private ?array $pathArgs;
	/**
	 * @var list<string>|null
	 */
	private ?array $methods;

	/** @param list<string>|null $methods */
	public function __construct(string $path = null, array $methods = null, private readonly int $priority = 0) {
		if (is_string($path) && preg_match_all(self::ROUTE_PATTERN_MATCH, $path, $matches)) {
			$this->pathArgs = $matches[1] ?? [];
			$path = '^' . preg_replace(self::ROUTE_PATTERN_REPLACE, self::REPLACE_PATTERN, $path) . '$';
		} elseif (is_string($path)) {
			$path = '^' . $path . '$';
			$this->pathArgs = null;
		}
		$this->path = is_string($path) ? strtolower($path) : null;
		$this->methods = is_array($methods) ? array_map(static fn(string $method): string => strtolower($method), $methods) : null;
	}

	/** @return string[]|null */
	public function matches(ServerRequestInterface $request): ?array {
		if ($this->methods !== null && !in_array(strtolower($request->getMethod()), $this->methods, true)) {
			return null;
		}
		if ($this->path === null) {
			return [];
		}
		if (!preg_match('#' . $this->path . '#', $request->getUri()->getPath(), $matches)) {
			return null;
		}
		return is_array($this->pathArgs) ?
			array_combine($this->pathArgs, array_slice($matches, 1)) : [];
	}

	public function getMatchPriority(): int {
		return $this->priority;
	}
}