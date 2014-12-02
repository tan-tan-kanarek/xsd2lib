<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdList extends XsdAnnotated
{
	/**
	 * @var string
	 */
	protected $itemType;
	
	/**
	 * @var array<XsdLocalSimpleType>
	 */
	protected $simpleTypeObjects = array();
	
	private static $attributes = array(
		'itemType' => 'string',
	);
	
	private static $children = array(
		'simpleType' => 'array<XsdLocalSimpleType>',
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
	public function getItemType()
	{
		return $this->itemType;
	}

	/**
	 * @param string $itemType
	 */
	public function setItemType($itemType)
	{
		$this->itemType = $itemType;
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
	
}