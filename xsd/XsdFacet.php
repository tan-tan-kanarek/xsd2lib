<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdFacet extends XsdAnnotated
{
	/**
	 * @var string
	 */
	protected $value;
	
	/**
	 * @var boolean
	 */
	protected $fixed;
	
	private static $attributes = array(
		'value' => 'string',
		'fixed' => 'boolean',
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
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @param string $value
	 */
	public function setValue($value)
	{
		$this->value = $value;
	}
	
	/**
	 * @return boolean
	 */
	public function getFixed()
	{
		return $this->fixed;
	}

	/**
	 * @param boolean $fixed
	 */
	public function setFixed($fixed)
	{
		$this->fixed = $fixed;
	}
	
}