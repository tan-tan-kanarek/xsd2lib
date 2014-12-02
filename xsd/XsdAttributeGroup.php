<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdAttributeGroup extends XsdAnnotated
{
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var string
	 */
	protected $ref;
	
	/**
	 * @var array<XsdAnyAttribute>
	 */
	protected $anyAttributeObjects = array();
	
	/**
	 * @var array<XsdAttribute>
	 */
	protected $attributeObjects = array();
	
	/**
	 * @var array<XsdAttributeGroupRef>
	 */
	protected $attributeGroupObjects = array();
	
	private static $attributes = array(
		'name' => 'string',
		'ref' => 'string',
	);
	
	private static $children = array(
		'anyAttribute' => 'array<XsdAnyAttribute>',
		'attribute' => 'array<XsdAttribute>',
		'attributeGroup' => 'array<XsdAttributeGroupRef>',
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
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}
	
	/**
	 * @return string
	 */
	public function getRef()
	{
		return $this->ref;
	}

	/**
	 * @param string $ref
	 */
	public function setRef($ref)
	{
		$this->ref = $ref;
	}
	
	/**
	 * @return array<XsdAnyAttribute>
	 */
	public function getAnyAttributeObjects()
	{
		return $this->anyAttributeObjects;
	}

	/**
	 * @param array<XsdAnyAttribute> $anyAttributeObjects
	 */
	public function setAnyAttributeObjects(array $anyAttributeObjects)
	{
		$this->anyAttributeObjects = $anyAttributeObjects;
	}
	
	/**
	 * @return array<XsdAnyAttribute>
	 */
	public function getAnyAttribute()
	{
		return reset($this->anyAttributeObjects);
	}
	
	/**
	 * @return array<XsdAttribute>
	 */
	public function getAttributeObjects()
	{
		return $this->attributeObjects;
	}

	/**
	 * @param array<XsdAttribute> $attributeObjects
	 */
	public function setAttributeObjects(array $attributeObjects)
	{
		$this->attributeObjects = $attributeObjects;
	}
	
	/**
	 * @return array<XsdAttribute>
	 */
	public function getAttribute()
	{
		return reset($this->attributeObjects);
	}
	
	/**
	 * @return array<XsdAttributeGroupRef>
	 */
	public function getAttributeGroupObjects()
	{
		return $this->attributeGroupObjects;
	}

	/**
	 * @param array<XsdAttributeGroupRef> $attributeGroupObjects
	 */
	public function setAttributeGroupObjects(array $attributeGroupObjects)
	{
		$this->attributeGroupObjects = $attributeGroupObjects;
	}
	
	/**
	 * @return array<XsdAttributeGroupRef>
	 */
	public function getAttributeGroup()
	{
		return reset($this->attributeGroupObjects);
	}
	
}