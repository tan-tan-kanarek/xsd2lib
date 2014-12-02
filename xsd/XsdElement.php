<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdElement extends XsdAnnotated
{
	/**
	 * @var string
	 */
	protected $type;
	
	/**
	 * @var string
	 */
	protected $substitutionGroup;
	
	/**
	 * @var string
	 */
	protected $default;
	
	/**
	 * @var string
	 */
	protected $fixed;
	
	/**
	 * @var boolean
	 */
	protected $nillable;
	
	/**
	 * @var boolean
	 */
	protected $abstract;
	
	/**
	 * @var XsdDerivationSet
	 */
	protected $final;
	
	/**
	 * @var XsdBlockSet
	 */
	protected $block;
	
	/**
	 * @var XsdFormChoice
	 */
	protected $form;
	
	/**
	 * @var string
	 */
	protected $targetNamespace;
	
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
	 * @var XsdAltType
	 */
	protected $alternative;
	
	/**
	 * @var array<XsdKeybase>
	 */
	protected $uniqueObjects = array();
	
	/**
	 * @var array<XsdKeybase>
	 */
	protected $keyObjects = array();
	
	/**
	 * @var array<XsdKeyref>
	 */
	protected $keyrefObjects = array();
	
	/**
	 * @var array<XsdLocalSimpleType>
	 */
	protected $simpleTypeObjects = array();
	
	/**
	 * @var array<XsdLocalComplexType>
	 */
	protected $complexTypeObjects = array();
	
	private static $attributes = array(
		'type' => 'string',
		'substitutionGroup' => 'string',
		'default' => 'string',
		'fixed' => 'string',
		'nillable' => 'boolean',
		'abstract' => 'boolean',
		'final' => 'XsdDerivationSet',
		'block' => 'XsdBlockSet',
		'form' => 'XsdFormChoice',
		'targetNamespace' => 'string',
		'name' => 'string',
		'ref' => 'string',
		'minOccurs' => 'int',
		'maxOccurs' => 'XsdAllNNI',
	);
	
	private static $children = array(
		'alternative' => 'XsdAltType',
		'unique' => 'array<XsdKeybase>',
		'key' => 'array<XsdKeybase>',
		'keyref' => 'array<XsdKeyref>',
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
	 * @return string
	 */
	public function getSubstitutionGroup()
	{
		return $this->substitutionGroup;
	}

	/**
	 * @param string $substitutionGroup
	 */
	public function setSubstitutionGroup($substitutionGroup)
	{
		$this->substitutionGroup = $substitutionGroup;
	}
	
	/**
	 * @return string
	 */
	public function getDefault()
	{
		return $this->default;
	}

	/**
	 * @param string $default
	 */
	public function setDefault($default)
	{
		$this->default = $default;
	}
	
	/**
	 * @return string
	 */
	public function getFixed()
	{
		return $this->fixed;
	}

	/**
	 * @param string $fixed
	 */
	public function setFixed($fixed)
	{
		$this->fixed = $fixed;
	}
	
	/**
	 * @return boolean
	 */
	public function getNillable()
	{
		return $this->nillable;
	}

	/**
	 * @param boolean $nillable
	 */
	public function setNillable($nillable)
	{
		$this->nillable = $nillable;
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
	 * @return XsdBlockSet
	 */
	public function getBlock()
	{
		return $this->block;
	}

	/**
	 * @param XsdBlockSet $block
	 */
	public function setBlock(XsdBlockSet $block)
	{
		$this->block = $block;
	}
	
	/**
	 * @return XsdFormChoice
	 */
	public function getForm()
	{
		return $this->form;
	}

	/**
	 * @param XsdFormChoice $form
	 */
	public function setForm(XsdFormChoice $form)
	{
		$this->form = $form;
	}
	
	/**
	 * @return string
	 */
	public function getTargetNamespace()
	{
		return $this->targetNamespace;
	}

	/**
	 * @param string $targetNamespace
	 */
	public function setTargetNamespace($targetNamespace)
	{
		$this->targetNamespace = $targetNamespace;
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
	 * @return XsdAltType
	 */
	public function getAlternative()
	{
		return $this->alternative;
	}

	/**
	 * @param XsdAltType $alternative
	 */
	public function setAlternative(XsdAltType $alternative)
	{
		$this->alternative = $alternative;
	}
	
	/**
	 * @return array<XsdKeybase>
	 */
	public function getUniqueObjects()
	{
		return $this->uniqueObjects;
	}

	/**
	 * @param array<XsdKeybase> $uniqueObjects
	 */
	public function setUniqueObjects(array $uniqueObjects)
	{
		$this->uniqueObjects = $uniqueObjects;
	}
	
	/**
	 * @return array<XsdKeybase>
	 */
	public function getUnique()
	{
		return reset($this->uniqueObjects);
	}
	
	/**
	 * @return array<XsdKeybase>
	 */
	public function getKeyObjects()
	{
		return $this->keyObjects;
	}

	/**
	 * @param array<XsdKeybase> $keyObjects
	 */
	public function setKeyObjects(array $keyObjects)
	{
		$this->keyObjects = $keyObjects;
	}
	
	/**
	 * @return array<XsdKeybase>
	 */
	public function getKey()
	{
		return reset($this->keyObjects);
	}
	
	/**
	 * @return array<XsdKeyref>
	 */
	public function getKeyrefObjects()
	{
		return $this->keyrefObjects;
	}

	/**
	 * @param array<XsdKeyref> $keyrefObjects
	 */
	public function setKeyrefObjects(array $keyrefObjects)
	{
		$this->keyrefObjects = $keyrefObjects;
	}
	
	/**
	 * @return array<XsdKeyref>
	 */
	public function getKeyref()
	{
		return reset($this->keyrefObjects);
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