<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdImport extends XsdAnnotated
{
	/**
	 * @var string
	 */
	protected $namespace;
	
	/**
	 * @var string
	 */
	protected $schemaLocation;
	
	private static $attributes = array(
		'namespace' => 'string',
		'schemaLocation' => 'string',
	);
	
	private static $children = array(
	);
	
	protected static function getAttributes()
	{
		return array_merge(parent::getAttributes(), self::$attributes);
	}
	
	protected static function getChildren()
	{
		return array_merge(parent::getChildren(), self::$children);
	}
	
	/**
	 * @return string
	 */
	public function getNamespace()
	{
		return $this->namespace;
	}

	/**
	 * @param string $namespace
	 */
	public function setNamespace($namespace)
	{
		$this->namespace = $namespace;
	}
	
	/**
	 * @return string
	 */
	public function getSchemaLocation()
	{
		return $this->schemaLocation;
	}

	/**
	 * @param string $schemaLocation
	 */
	public function setSchemaLocation($schemaLocation)
	{
		$this->schemaLocation = $schemaLocation;
	}
	
}