<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdGroup extends XsdAnnotated
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
	 * @var int
	 */
	protected $minOccurs;
	
	/**
	 * @var XsdAllNNI
	 */
	protected $maxOccurs;
	
	/**
	 * @var array<XsdLocalElement>
	 */
	protected $elementObjects = array();
	
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
	 * @var array<XsdAny>
	 */
	protected $anyObjects = array();
	
	private static $attributes = array(
		'name' => 'string',
		'ref' => 'string',
		'minOccurs' => 'int',
		'maxOccurs' => 'XsdAllNNI',
	);
	
	private static $children = array(
		'element' => 'array<XsdLocalElement>',
		'group' => 'array<XsdGroupRef>',
		'all' => 'array<XsdAll>',
		'choice' => 'array<XsdExplicitGroup>',
		'sequence' => 'array<XsdExplicitGroup>',
		'any' => 'array<XsdAny>',
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
	 * @return int
	 */
	public function getMinOccurs()
	{
		return $this->minOccurs;
	}

	/**
	 * @param int $minOccurs
	 */
	public function setMinOccurs($minOccurs)
	{
		$this->minOccurs = $minOccurs;
	}
	
	/**
	 * @return XsdAllNNI
	 */
	public function getMaxOccurs()
	{
		return $this->maxOccurs;
	}

	/**
	 * @param XsdAllNNI $maxOccurs
	 */
	public function setMaxOccurs(XsdAllNNI $maxOccurs)
	{
		$this->maxOccurs = $maxOccurs;
	}
	
	/**
	 * @return array<XsdLocalElement>
	 */
	public function getElementObjects()
	{
		return $this->elementObjects;
	}

	/**
	 * @param array<XsdLocalElement> $elementObjects
	 */
	public function setElementObjects(array $elementObjects)
	{
		$this->elementObjects = $elementObjects;
	}
	
	/**
	 * @return array<XsdLocalElement>
	 */
	public function getElement()
	{
		return reset($this->elementObjects);
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
	 * @return array<XsdAny>
	 */
	public function getAnyObjects()
	{
		return $this->anyObjects;
	}

	/**
	 * @param array<XsdAny> $anyObjects
	 */
	public function setAnyObjects(array $anyObjects)
	{
		$this->anyObjects = $anyObjects;
	}
	
	/**
	 * @return array<XsdAny>
	 */
	public function getAny()
	{
		return reset($this->anyObjects);
	}
	
}