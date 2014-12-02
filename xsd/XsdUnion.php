<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdUnion extends XsdAnnotated
{
	/**
	 * @var string
	 */
	protected $memberTypes;
	
	/**
	 * @var XsdLocalSimpleType
	 */
	protected $simpleType;
	
	private static $attributes = array(
		'memberTypes' => 'string',
	);
	
	private static $children = array(
		'simpleType' => 'XsdLocalSimpleType',
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
	public function getMemberTypes()
	{
		return $this->memberTypes;
	}

	/**
	 * @param string $memberTypes
	 */
	public function setMemberTypes($memberTypes)
	{
		$this->memberTypes = $memberTypes;
	}
	
	/**
	 * @return XsdLocalSimpleType
	 */
	public function getSimpleType()
	{
		return $this->simpleType;
	}

	/**
	 * @param XsdLocalSimpleType $simpleType
	 */
	public function setSimpleType(XsdLocalSimpleType $simpleType)
	{
		$this->simpleType = $simpleType;
	}
	
}