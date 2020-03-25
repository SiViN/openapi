<?php declare(strict_types = 1);

namespace Apitte\OpenApi\Schema;

class Components
{

	/** @var Schema[]|Reference[] */
	private $schemas = [];

	/** @var Response[]|Reference[] */
	private $responses = [];

	/** @var Parameter[]|Reference[] */
	private $parameters = [];

	/** @var Example[]|Reference[] */
	private $examples = [];

	/** @var RequestBody[]|Reference[] */
	private $requestBodies = [];

	/** @var Header[]|Reference[] */
	private $headers = [];

	/** @var SecurityScheme[]|Reference[] */
	private $securitySchemes = [];

	/** @var Link[]|Reference[] */
	private $links = [];

	/** @var Callback[]|Reference[] */
	private $callbacks = [];

	/**
	 * @param mixed[] $data
	 */
	public static function fromArray(array $data): Components
	{
		$components = new Components();
		if (isset($data['schemas'])) {
			foreach ($data['schemas'] as $schemaKey => $schemaData) {
				$components->setSchema($schemaKey, Schema::fromArray($schemaData));
			}
		}
		if (isset($data['securitySchemes'])) {
			foreach ($data['securitySchemes'] as $schemaKey => $schemeData) {
				$components->setSecurityScheme($schemaKey, Schema::fromArray($schemeData));
			}
		}
		return $components;
	}

	/**
	 * @param Schema|Reference $schema
	 */
	public function setSchema(string $name, $schema): void
	{
		$this->schemas[$name] = $schema;
	}

	/**
	 * @param string $name
	 * @param $scheme
	 */
	public function setSecurityScheme(string $name, $scheme): void
	{
		$this->securitySchemes[$name] = $scheme;
	}

	/**
	 * @return mixed[]
	 */
	public function toArray(): array
	{
		$data = [];
		foreach ($this->schemas as $schemaKey => $schema) {
			$data['schemas'][$schemaKey] = $schema->toArray();
		}
		foreach ($this->securitySchemes as $schemeKey => $scheme) {
			$data['securitySchemes'][$schemeKey] = $scheme->toArray();
		}
		return $data;
	}

}
