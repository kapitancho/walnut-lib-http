<?php

namespace Walnut\Lib\Http\Mapper\Attribute\RequestMapper;

use Attribute;
use Psr\Http\Message\ServerRequestInterface;
use Walnut\Lib\Http\Mapper\RequestMapper;

#[Attribute]
final readonly class FromCookie implements RequestMapper {

	public function __construct(private string $cookieName, private string $defaultValue = '') {}

	public function mapValue(ServerRequestInterface $request, string $argName, array $requestMatchArgs): string {
		return (string)($request->getCookieParams()[$this->cookieName] ?? $this->defaultValue);
	}
}