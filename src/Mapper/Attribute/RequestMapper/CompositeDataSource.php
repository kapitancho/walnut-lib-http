<?php

namespace Walnut\Lib\Http\Mapper\Attribute\RequestMapper;

use Attribute;
use stdClass;
use Psr\Http\Message\ServerRequestInterface;
use Walnut\Lib\Http\Mapper\InvalidCompositeValue;
use Walnut\Lib\Http\Mapper\RequestMapper;

#[Attribute]
final readonly class CompositeDataSource implements RequestMapper {

	/** @param RequestMapper[] $additionalDataSources */
	public function __construct(
		private RequestMapper $mainDataSource,
		private array         $additionalDataSources
	) {}

	/** @throws InvalidCompositeValue */
	public function mapValue(
		ServerRequestInterface $request,
		string $argName,
		array $requestMatchArgs
	): array|object {
		$result = $this->mainDataSource->mapValue($request, $argName, $requestMatchArgs);
		if (is_array($result)) {
			foreach($this->additionalDataSources as $key => $dataSource) {
				$result[$key] = $dataSource->mapValue($request, $argName, $requestMatchArgs);
			}
		} elseif ($result instanceof stdClass) {
			foreach($this->additionalDataSources as $key => $dataSource) {
				$result->$key = $dataSource->mapValue($request, $argName, $requestMatchArgs);
			}
		} else {
			throw new InvalidCompositeValue;
		}
		return $result;
	}

}