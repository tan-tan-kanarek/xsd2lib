<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdOpenContent extends XsdAnnotated
{
	/**
	 * @var string
	 */
	protected $mode;
	
	/**
	 * @var array<XsdWildcard>
	 */
	protected $anyObjects = array();
	
	private static $attributes = array(
		'mode' => 'string',
	);
	
	private static $children = array(
		'any' => 'array<XsdWildcard>',
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
	public function getMode()
	{
		return $this->mode;
	}

	/**
	 * @param string $mode
	 */
	public function setMode($mode)
	{
		$this->mode = $mode;
	}
	
	/**
	 * @return array<XsdWildcard>
	 */
	public function getAnyObjects()
	{
		return $this->anyObjects;
	}

	/**
	 * @param array<XsdWildcard> $anyObjects
	 */
	public function setAnyObjects(array $anyObjects)
	{
		$this->anyObjects = $anyObjects;
	}
	
	/**
	 * @return array<XsdWildcard>
	 */
	public function getAny()
	{
		return reset($this->anyObjects);
	}
	
}