<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdComplexType extends XsdAnnotated
{
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var boolean
	 */
	protected $mixed;
	
	/**
	 * @var boolean
	 */
	protected $abstract;
	
	/**
	 * @var XsdDerivationSet
	 */
	protected $final;
	
	/**
	 * @var XsdDerivationSet
	 */
	protected $block;
	
	/**
	 * @var boolean
	 */
	protected $defaultAttributesApply;
	
	/**
	 * @var array<XsdSimpleContent>
	 */
	protected $simpleContentObjects = array();
	
	/**
	 * @var array<XsdComplexContent>
	 */
	protected $complexContentObjects = array();
	
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
	
	private static $attributes = array(
		'name' => 'string',
		'mixed' => 'boolean',
		'abstract' => 'boolean',
		'final' => 'XsdDerivationSet',
		'block' => 'XsdDerivationSet',
		'defaultAttributesApply' => 'boolean',
	);
	
	private static $children = array(
		'simpleContent' => 'array<XsdSimpleContent>',
		'complexContent' => 'array<XsdComplexContent>',
		'openContent' => 'array<XsdOpenContent>',
		'group' => 'array<XsdGroupRef>',
		'all' => 'array<XsdAll>',
		'choice' => 'array<XsdExplicitGroup>',
		'sequence' => 'array<XsdExplicitGroup>',
		'anyAttribute' => 'array<XsdAnyAttribute>',
		'attribute' => 'array<XsdAttribute>',
		'attributeGroup' => 'array<XsdAttributeGroupRef>',
		'assert' => 'XsdAssertion',
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
	 * @return boolean
	 */
	public function getMixed()
	{
		return $this->mixed;
	}

	/**
	 * @param boolean $mixed
	 */
	public function setMixed($mixed)
	{
		$this->mixed = $mixed;
	}
	
	/**
	 * @return boolean
	 */
	public function getAbstract()
	{
		return $this->abstract;
	}

	/**
	 * @param boolean $abstract
	 */
	public function setAbstract($abstract)
	{
		$this->abstract = $abstract;
	}
	
	/**
	 * @return XsdDerivationSet
	 */
	public function getFinal()
	{
		return $this->final;
	}

	/**
	 * @param XsdDerivationSet $final
	 */
	public function setFinal(XsdDerivationSet $final)
	{
		$this->final = $final;
	}
	
	/**
	 * @return XsdDerivationSet
	 */
	public function getBlock()
	{
		return $this->block;
	}

	/**
	 * @param XsdDerivationSet $block
	 */
	public function setBlock(XsdDerivationSet $block)
	{
		$this->block = $block;
	}
	
	/**
	 * @return boolean
	 */
	public function getDefaultAttributesApply()
	{
		return $this->defaultAttributesApply;
	}

	/**
	 * @param boolean $defaultAttributesApply
	 */
	public function setDefaultAttributesApply($defaultAttributesApply)
	{
		$this->defaultAttributesApply = $defaultAttributesApply;
	}
	
	/**
	 * @return array<XsdSimpleContent>
	 */
	public function getSimpleContentObjects()
	{
		return $this->simpleContentObjects;
	}

	/**
	 * @param array<XsdSimpleContent> $simpleContentObjects
	 */
	public function setSimpleContentObjects(array $simpleContentObjects)
	{
		$this->simpleContentObjects = $simpleContentObjects;
	}
	
	/**
	 * @return array<XsdSimpleContent>
	 */
	public function getSimpleContent()
	{
		return reset($this->simpleContentObjects);
	}
	
	/**
	 * @return array<XsdComplexContent>
	 */
	public function getComplexContentObjects()
	{
		return $this->complexContentObjects;
	}

	/**
	 * @param array<XsdComplexContent> $complexContentObjects
	 */
	public function setComplexContentObjects(array $complexContentObjects)
	{
		$this->complexContentObjects = $complexContentObjects;
	}
	
	/**
	 * @return array<XsdComplexContent>
	 */
	public function getComplexContent()
	{
		return reset($this->complexContentObjects);
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
	
}