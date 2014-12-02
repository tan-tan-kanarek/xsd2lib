<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdSimpleType extends XsdAnnotated
{
	/**
	 * @var XsdSimpleDerivationSet
	 */
	protected $final;
	
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var array<XsdRestriction>
	 */
	protected $restrictionObjects = array();
	
	/**
	 * @var array<XsdList>
	 */
	protected $listObjects = array();
	
	/**
	 * @var array<XsdUnion>
	 */
	protected $unionObjects = array();
	
	private static $attributes = array(
		'final' => 'XsdSimpleDerivationSet',
		'name' => 'string',
	);
	
	private static $children = array(
		'restriction' => 'array<XsdRestriction>',
		'list' => 'array<XsdList>',
		'union' => 'array<XsdUnion>',
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
	 * @return XsdSimpleDerivationSet
	 */
	public function getFinal()
	{
		return $this->final;
	}

	/**
	 * @param XsdSimpleDerivationSet $final
	 */
	public function setFinal(XsdSimpleDerivationSet $final)
	{
		$this->final = $final;
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
	 * @return array<XsdRestriction>
	 */
	public function getRestrictionObjects()
	{
		return $this->restrictionObjects;
	}

	/**
	 * @param array<XsdRestriction> $restrictionObjects
	 */
	public function setRestrictionObjects(array $restrictionObjects)
	{
		$this->restrictionObjects = $restrictionObjects;
	}
	
	/**
	 * @return array<XsdRestriction>
	 */
	public function getRestriction()
	{
		return reset($this->restrictionObjects);
	}
	
	/**
	 * @return array<XsdList>
	 */
	public function getListObjects()
	{
		return $this->listObjects;
	}

	/**
	 * @param array<XsdList> $listObjects
	 */
	public function setListObjects(array $listObjects)
	{
		$this->listObjects = $listObjects;
	}
	
	/**
	 * @return array<XsdList>
	 */
	public function getList()
	{
		return reset($this->listObjects);
	}
	
	/**
	 * @return array<XsdUnion>
	 */
	public function getUnionObjects()
	{
		return $this->unionObjects;
	}

	/**
	 * @param array<XsdUnion> $unionObjects
	 */
	public function setUnionObjects(array $unionObjects)
	{
		$this->unionObjects = $unionObjects;
	}
	
	/**
	 * @return array<XsdUnion>
	 */
	public function getUnion()
	{
		return reset($this->unionObjects);
	}
	
}