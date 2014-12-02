<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdSimpleContent extends XsdAnnotated
{
	/**
	 * @var array<XsdSimpleRestrictionType>
	 */
	protected $restrictionObjects = array();
	
	/**
	 * @var array<XsdSimpleExtensionType>
	 */
	protected $extensionObjects = array();
	
	private static $attributes = array(
	);
	
	private static $children = array(
		'restriction' => 'array<XsdSimpleRestrictionType>',
		'extension' => 'array<XsdSimpleExtensionType>',
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
	 * @return array<XsdSimpleRestrictionType>
	 */
	public function getRestrictionObjects()
	{
		return $this->restrictionObjects;
	}

	/**
	 * @param array<XsdSimpleRestrictionType> $restrictionObjects
	 */
	public function setRestrictionObjects(array $restrictionObjects)
	{
		$this->restrictionObjects = $restrictionObjects;
	}
	
	/**
	 * @return array<XsdSimpleRestrictionType>
	 */
	public function getRestriction()
	{
		return reset($this->restrictionObjects);
	}
	
	/**
	 * @return array<XsdSimpleExtensionType>
	 */
	public function getExtensionObjects()
	{
		return $this->extensionObjects;
	}

	/**
	 * @param array<XsdSimpleExtensionType> $extensionObjects
	 */
	public function setExtensionObjects(array $extensionObjects)
	{
		$this->extensionObjects = $extensionObjects;
	}
	
	/**
	 * @return array<XsdSimpleExtensionType>
	 */
	public function getExtension()
	{
		return reset($this->extensionObjects);
	}
	
}