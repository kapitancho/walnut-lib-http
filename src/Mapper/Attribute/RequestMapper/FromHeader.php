<?php

namespace Walnut\Lib\Http\Mapper\Attribute\RequestMapper;

use Attribute;
use Psr\Http\Message\ServerRequestInterface;
use Walnut\Lib\Http\Mapper\RequestMapper;

#[Attribute]
final readonly class FromHeader implements RequestMapper {

	public function __construct(private string $headerName, private string $defaultValue = '') {}

	public function mapValue(ServerRequestInterface $request, string $argName, array $requestMatchArgs): string {
		$value = $request->getHeaderLine($this->headerName);
		return $value !== '' ? $value : $this->defaultValue;
	}
}