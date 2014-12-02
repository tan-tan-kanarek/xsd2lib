<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdKeybase.php';


class XsdKeyref extends XsdKeybase
{
	/**
	 * @var string
	 */
	protected $refer;
	
	private static $attributes = array(
		'refer' => 'string',
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
	public function getRefer()
	{
		return $this->refer;
	}

	/**
	 * @param string $refer
	 */
	public function setRefer($refer)
	{
		$this->refer = $refer;
	}
	
}