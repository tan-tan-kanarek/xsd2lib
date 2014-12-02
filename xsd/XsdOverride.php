<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdOpenAttrs.php';


class XsdOverride extends XsdOpenAttrs
{
	/**
	 * @var string
	 */
	protected $schemaLocation;
	
	/**
	 * @var string
	 */
	protected $id;
	
	/**
	 * @var array<XsdAnnotation>
	 */
	protected $annotationObjects = array();
	
	/**
	 * @var array<XsdTopLevelElement>
	 */
	protected $elementObjects = array();
	
	/**
	 * @var array<XsdTopLevelAttribute>
	 */
	protected $attributeObjects = array();
	
	/**
	 * @var array<XsdNotation>
	 */
	protected $notationObjects = array();
	
	/**
	 * @var array<XsdTopLevelSimpleType>
	 */
	protected $simpleTypeObjects = array();
	
	/**
	 * @var array<XsdTopLevelComplexType>
	 */
	protected $complexTypeObjects = array();
	
	/**
	 * @var array<XsdNamedGroup>
	 */
	protected $groupObjects = array();
	
	/**
	 * @var array<XsdNamedAttributeGroup>
	 */
	protected $attributeGroupObjects = array();
	
	private static $attributes = array(
		'schemaLocation' => 'string',
		'id' => 'string',
	);
	
	private static $children = array(
		'annotation' => 'array<XsdAnnotation>',
		'element' => 'array<XsdTopLevelElement>',
		'attribute' => 'array<XsdTopLevelAttribute>',
		'notation' => 'array<XsdNotation>',
		'simpleType' => 'array<XsdTopLevelSimpleType>',
		'complexType' => 'array<XsdTopLevelComplexType>',
		'group' => 'array<XsdNamedGroup>',
		'attributeGroup' => 'array<XsdNamedAttributeGroup>',
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
	
	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param string $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}
	
	/**
	 * @return array<XsdAnnotation>
	 */
	public function getAnnotationObjects()
	{
		return $this->annotationObjects;
	}

	/**
	 * @param array<XsdAnnotation> $annotationObjects
	 */
	public function setAnnotationObjects(array $annotationObjects)
	{
		$this->annotationObjects = $annotationObjects;
	}
	
	/**
	 * @return array<XsdAnnotation>
	 */
	public function getAnnotation()
	{
		return reset($this->annotationObjects);
	}
	
	/**
	 * @return array<XsdTopLevelElement>
	 */
	public function getElementObjects()
	{
		return $this->elementObjects;
	}

	/**
	 * @param array<XsdTopLevelElement> $elementObjects
	 */
	public function setElementObjects(array $elementObjects)
	{
		$this->elementObjects = $elementObjects;
	}
	
	/**
	 * @return array<XsdTopLevelElement>
	 */
	public function getElement()
	{
		return reset($this->elementObjects);
	}
	
	/**
	 * @return array<XsdTopLevelAttribute>
	 */
	public function getAttributeObjects()
	{
		return $this->attributeObjects;
	}

	/**
	 * @param array<XsdTopLevelAttribute> $attributeObjects
	 */
	public function setAttributeObjects(array $attributeObjects)
	{
		$this->attributeObjects = $attributeObjects;
	}
	
	/**
	 * @return array<XsdTopLevelAttribute>
	 */
	public function getAttribute()
	{
		return reset($this->attributeObjects);
	}
	
	/**
	 * @return array<XsdNotation>
	 */
	public function getNotationObjects()
	{
		return $this->notationObjects;
	}

	/**
	 * @param array<XsdNotation> $notationObjects
	 */
	public function setNotationObjects(array $notationObjects)
	{
		$this->notationObjects = $notationObjects;
	}
	
	/**
	 * @return array<XsdNotation>
	 */
	public function getNotation()
	{
		return reset($this->notationObjects);
	}
	
	/**
	 * @return array<XsdTopLevelSimpleType>
	 */
	public function getSimpleTypeObjects()
	{
		return $this->simpleTypeObjects;
	}

	/**
	 * @param array<XsdTopLevelSimpleType> $simpleTypeObjects
	 */
	public function setSimpleTypeObjects(array $simpleTypeObjects)
	{
		$this->simpleTypeObjects = $simpleTypeObjects;
	}
	
	/**
	 * @return array<XsdTopLevelSimpleType>
	 */
	public function getSimpleType()
	{
		return reset($this->simpleTypeObjects);
	}
	
	/**
	 * @return array<XsdTopLevelComplexType>
	 */
	public function getComplexTypeObjects()
	{
		return $this->complexTypeObjects;
	}

	/**
	 * @param array<XsdTopLevelComplexType> $complexTypeObjects
	 */
	public function setComplexTypeObjects(array $complexTypeObjects)
	{
		$this->complexTypeObjects = $complexTypeObjects;
	}
	
	/**
	 * @return array<XsdTopLevelComplexType>
	 */
	public function getComplexType()
	{
		return reset($this->complexTypeObjects);
	}
	
	/**
	 * @return array<XsdNamedGroup>
	 */
	public function getGroupObjects()
	{
		return $this->groupObjects;
	}

	/**
	 * @param array<XsdNamedGroup> $groupObjects
	 */
	public function setGroupObjects(array $groupObjects)
	{
		$this->groupObjects = $groupObjects;
	}
	
	/**
	 * @return array<XsdNamedGroup>
	 */
	public function getGroup()
	{
		return reset($this->groupObjects);
	}
	
	/**
	 * @return array<XsdNamedAttributeGroup>
	 */
	public function getAttributeGroupObjects()
	{
		return $this->attributeGroupObjects;
	}

	/**
	 * @param array<XsdNamedAttributeGroup> $attributeGroupObjects
	 */
	public function setAttributeGroupObjects(array $attributeGroupObjects)
	{
		$this->attributeGroupObjects = $attributeGroupObjects;
	}
	
	/**
	 * @return array<XsdNamedAttributeGroup>
	 */
	public function getAttributeGroup()
	{
		return reset($this->attributeGroupObjects);
	}
	
}