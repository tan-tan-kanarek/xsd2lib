<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdComplexContent extends XsdAnnotated
{
	/**
	 * @var boolean
	 */
	protected $mixed;
	
	/**
	 * @var array<XsdComplexRestrictionType>
	 */
	protected $restrictionObjects = array();
	
	/**
	 * @var array<XsdExtensionType>
	 */
	protected $extensionObjects = array();
	
	private static $attributes = array(
		'mixed' => 'boolean',
	);
	
	private static $children = array(
		'restriction' => 'array<XsdComplexRestrictionType>',
		'extension' => 'array<XsdExtensionType>',
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
	 * @return array<XsdComplexRestrictionType>
	 */
	public function getRestrictionObjects()
	{
		return $this->restrictionObjects;
	}

	/**
	 * @param array<XsdComplexRestrictionType> $restrictionObjects
	 */
	public function setRestrictionObjects(array $restrictionObjects)
	{
		$this->restrictionObjects = $restrictionObjects;
	}
	
	/**
	 * @return array<XsdComplexRestrictionType>
	 */
	public function getRestriction()
	{
		return reset($this->restrictionObjects);
	}
	
	/**
	 * @return array<XsdExtensionType>
	 */
	public function getExtensionObjects()
	{
		return $this->extensionObjects;
	}

	/**
	 * @param array<XsdExtensionType> $extensionObjects
	 */
	public function setExtensionObjects(array $extensionObjects)
	{
		$this->extensionObjects = $extensionObjects;
	}
	
	/**
	 * @return array<XsdExtensionType>
	 */
	public function getExtension()
	{
		return reset($this->extensionObjects);
	}
	
}