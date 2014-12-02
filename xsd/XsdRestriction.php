<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdRestriction extends XsdAnnotated
{
	/**
	 * @var string
	 */
	protected $base;
	
	/**
	 * @var array<XsdLocalSimpleType>
	 */
	protected $simpleTypeObjects = array();
	
	/**
	 * @var array<XsdFacet>
	 */
	protected $facetObjects = array();
	
	private static $attributes = array(
		'base' => 'string',
	);
	
	private static $children = array(
		'simpleType' => 'array<XsdLocalSimpleType>',
		'facet' => 'array<XsdFacet>',
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
	public function getBase()
	{
		return $this->base;
	}

	/**
	 * @param string $base
	 */
	public function setBase($base)
	{
		$this->base = $base;
	}
	
	/**
	 * @return array<XsdLocalSimpleType>
	 */
	public function getSimpleTypeObjects()
	{
		return $this->simpleTypeObjects;
	}

	/**
	 * @param array<XsdLocalSimpleType> $simpleTypeObjects
	 */
	public function setSimpleTypeObjects(array $simpleTypeObjects)
	{
		$this->simpleTypeObjects = $simpleTypeObjects;
	}
	
	/**
	 * @return array<XsdLocalSimpleType>
	 */
	public function getSimpleType()
	{
		return reset($this->simpleTypeObjects);
	}
	
	/**
	 * @return array<XsdFacet>
	 */
	public function getFacetObjects()
	{
		return $this->facetObjects;
	}

	/**
	 * @param array<XsdFacet> $facetObjects
	 */
	public function setFacetObjects(array $facetObjects)
	{
		$this->facetObjects = $facetObjects;
	}
	
	/**
	 * @return array<XsdFacet>
	 */
	public function getFacet()
	{
		return reset($this->facetObjects);
	}
	
}