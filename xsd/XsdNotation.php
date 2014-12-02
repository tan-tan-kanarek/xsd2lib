<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdNotation extends XsdAnnotated
{
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var XsdPublic
	 */
	protected $public;
	
	/**
	 * @var string
	 */
	protected $system;
	
	private static $attributes = array(
		'name' => 'string',
		'public' => 'XsdPublic',
		'system' => 'string',
	);
	
	private static $children = array(
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
	 * @return XsdPublic
	 */
	public function getPublic()
	{
		return $this->public;
	}

	/**
	 * @param XsdPublic $public
	 */
	public function setPublic(XsdPublic $public)
	{
		$this->public = $public;
	}
	
	/**
	 * @return string
	 */
	public function getSystem()
	{
		return $this->system;
	}

	/**
	 * @param string $system
	 */
	public function setSystem($system)
	{
		$this->system = $system;
	}
	
}