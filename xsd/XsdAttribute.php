<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdAttribute extends XsdAnnotated
{
	/**
	 * @var string
	 */
	protected $type;
	
	/**
	 * @var string
	 */
	protected $use;
	
	/**
	 * @var string
	 */
	protected $default;
	
	/**
	 * @var string
	 */
	protected $fixed;
	
	/**
	 * @var XsdFormChoice
	 */
	protected $form;
	
	/**
	 * @var string
	 */
	protected $targetNamespace;
	
	/**
	 * @var boolean
	 */
	protected $inheritable;
	
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var string
	 */
	protected $ref;
	
	/**
	 * @var array<XsdLocalSimpleType>
	 */
	protected $simpleTypeObjects = array();
	
	private static $attributes = array(
		'type' => 'string',
		'use' => 'string',
		'default' => 'string',
		'fixed' => 'string',
		'form' => 'XsdFormChoice',
		'targetNamespace' => 'string',
		'inheritable' => 'boolean',
		'name' => 'string',
		'ref' => 'string',
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
	public function getUse()
	{
		return $this->use;
	}

	/**
	 * @param string $use
	 */
	public function setUse($use)
	{
		$this->use = $use;
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
	 * @return boolean
	 */
	public function getInheritable()
	{
		return $this->inheritable;
	}

	/**
	 * @param boolean $inheritable
	 */
	public function setInheritable($inheritable)
	{
		$this->inheritable = $inheritable;
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