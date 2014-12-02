<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdRestrictionType extends XsdAnnotated
{
	/**
	 * @var string
	 */
	protected $base;
	
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
	
	/**
	 * @var XsdAssertion
	 */
	protected $assert;
	
	/**
	 * @var array<XsdLocalSimpleType>
	 */
	protected $simpleTypeObjects = array();
	
	/**
	 * @var array<XsdFacet>
	 */
	protected $facetObjects = array();
	
	/**
	 * @var array<XsdOpenContent>
	 */
	protected $openContentObjects = array();
	
	/**
	 * @var array<XsdGroupRef>
	 */
	protected $groupObjects = array();
	
	/**
	 * @var array<XsdAll>
	 */
	protected $allObjects = array();
	
	/**
	 * @var array<XsdExplicitGroup>
	 */
	protected $choiceObjects = array();
	
	/**
	 * @var array<XsdExplicitGroup>
	 */
	protected $sequenceObjects = array();
	
	private static $attributes = array(
		'base' => 'string',
	);
	
	private static $children = array(
		'anyAttribute' => 'array<XsdAnyAttribute>',
		'attribute' => 'array<XsdAttribute>',
		'attributeGroup' => 'array<XsdAttributeGroupRef>',
		'assert' => 'XsdAssertion',
		'simpleType' => 'array<XsdLocalSimpleType>',
		'facet' => 'array<XsdFacet>',
		'openContent' => 'array<XsdOpenContent>',
		'group' => 'array<XsdGroupRef>',
		'all' => 'array<XsdAll>',
		'choice' => 'array<XsdExplicitGroup>',
		'sequence' => 'array<XsdExplicitGroup>',
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
	
	/**
	 * @return XsdAssertion
	 */
	public function getAssert()
	{
		return $this->assert;
	}

	/**
	 * @param XsdAssertion $assert
	 */
	public function setAssert(XsdAssertion $assert)
	{
		$this->assert = $assert;
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
	
	/**
	 * @return array<XsdOpenContent>
	 */
	public function getOpenContentObjects()
	{
		return $this->openContentObjects;
	}

	/**
	 * @param array<XsdOpenContent> $openContentObjects
	 */
	public function setOpenContentObjects(array $openContentObjects)
	{
		$this->openContentObjects = $openContentObjects;
	}
	
	/**
	 * @return array<XsdOpenContent>
	 */
	public function getOpenContent()
	{
		return reset($this->openContentObjects);
	}
	
	/**
	 * @return array<XsdGroupRef>
	 */
	public function getGroupObjects()
	{
		return $this->groupObjects;
	}

	/**
	 * @param array<XsdGroupRef> $groupObjects
	 */
	public function setGroupObjects(array $groupObjects)
	{
		$this->groupObjects = $groupObjects;
	}
	
	/**
	 * @return array<XsdGroupRef>
	 */
	public function getGroup()
	{
		return reset($this->groupObjects);
	}
	
	/**
	 * @return array<XsdAll>
	 */
	public function getAllObjects()
	{
		return $this->allObjects;
	}

	/**
	 * @param array<XsdAll> $allObjects
	 */
	public function setAllObjects(array $allObjects)
	{
		$this->allObjects = $allObjects;
	}
	
	/**
	 * @return array<XsdAll>
	 */
	public function getAll()
	{
		return reset($this->allObjects);
	}
	
	/**
	 * @return array<XsdExplicitGroup>
	 */
	public function getChoiceObjects()
	{
		return $this->choiceObjects;
	}

	/**
	 * @param array<XsdExplicitGroup> $choiceObjects
	 */
	public function setChoiceObjects(array $choiceObjects)
	{
		$this->choiceObjects = $choiceObjects;
	}
	
	/**
	 * @return array<XsdExplicitGroup>
	 */
	public function getChoice()
	{
		return reset($this->choiceObjects);
	}
	
	/**
	 * @return array<XsdExplicitGroup>
	 */
	public function getSequenceObjects()
	{
		return $this->sequenceObjects;
	}

	/**
	 * @param array<XsdExplicitGroup> $sequenceObjects
	 */
	public function setSequenceObjects(array $sequenceObjects)
	{
		$this->sequenceObjects = $sequenceObjects;
	}
	
	/**
	 * @return array<XsdExplicitGroup>
	 */
	public function getSequence()
	{
		return reset($this->sequenceObjects);
	}
	
}