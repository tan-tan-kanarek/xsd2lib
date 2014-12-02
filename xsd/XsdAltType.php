<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdAltType extends XsdAnnotated
{
	/**
	 * @var string
	 */
	protected $test;
	
	/**
	 * @var string
	 */
	protected $type;
	
	/**
	 * @var XsdXpathDefaultNamespace
	 */
	protected $xpathDefaultNamespace;
	
	/**
	 * @var array<XsdLocalSimpleType>
	 */
	protected $simpleTypeObjects = array();
	
	/**
	 * @var array<XsdLocalComplexType>
	 */
	protected $complexTypeObjects = array();
	
	private static $attributes = array(
		'test' => 'string',
		'type' => 'string',
		'xpathDefaultNamespace' => 'XsdXpathDefaultNamespace',
	);
	
	private static $children = array(
		'simpleType' => 'array<XsdLocalSimpleType>',
		'complexType' => 'array<XsdLocalComplexType>',
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
	public function getTest()
	{
		return $this->test;
	}

	/**
	 * @param string $test
	 */
	public function setTest($test)
	{
		$this->test = $test;
	}
	
	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @param string $type
	 */
	public function setType($type)
	{
		$this->type = $type;
	}
	
	/**
	 * @return XsdXpathDefaultNamespace
	 */
	public function getXpathDefaultNamespace()
	{
		return $this->xpathDefaultNamespace;
	}

	/**
	 * @param XsdXpathDefaultNamespace $xpathDefaultNamespace
	 */
	public function setXpathDefaultNamespace(XsdXpathDefaultNamespace $xpathDefaultNamespace)
	{
		$this->xpathDefaultNamespace = $xpathDefaultNamespace;
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
	 * @return array<XsdLocalComplexType>
	 */
	public function getComplexTypeObjects()
	{
		return $this->complexTypeObjects;
	}

	/**
	 * @param array<XsdLocalComplexType> $complexTypeObjects
	 */
	public function setComplexTypeObjects(array $complexTypeObjects)
	{
		$this->complexTypeObjects = $complexTypeObjects;
	}
	
	/**
	 * @return array<XsdLocalComplexType>
	 */
	public function getComplexType()
	{
		return reset($this->complexTypeObjects);
	}
	
}