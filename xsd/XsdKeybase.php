<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdKeybase extends XsdAnnotated
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
	 * @var array<XsdSelector>
	 */
	protected $selectorObjects = array();
	
	/**
	 * @var array<XsdField>
	 */
	protected $fieldObjects = array();
	
	private static $attributes = array(
		'name' => 'string',
		'ref' => 'string',
	);
	
	private static $children = array(
		'selector' => 'array<XsdSelector>',
		'field' => 'array<XsdField>',
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
	 * @return array<XsdSelector>
	 */
	public function getSelectorObjects()
	{
		return $this->selectorObjects;
	}

	/**
	 * @param array<XsdSelector> $selectorObjects
	 */
	public function setSelectorObjects(array $selectorObjects)
	{
		$this->selectorObjects = $selectorObjects;
	}
	
	/**
	 * @return array<XsdSelector>
	 */
	public function getSelector()
	{
		return reset($this->selectorObjects);
	}
	
	/**
	 * @return array<XsdField>
	 */
	public function getFieldObjects()
	{
		return $this->fieldObjects;
	}

	/**
	 * @param array<XsdField> $fieldObjects
	 */
	public function setFieldObjects(array $fieldObjects)
	{
		$this->fieldObjects = $fieldObjects;
	}
	
	/**
	 * @return array<XsdField>
	 */
	public function getField()
	{
		return reset($this->fieldObjects);
	}
	
}