<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdObject.php';


class XsdAppinfo extends XsdObject
{
	/**
	 * @var string
	 */
	protected $source;
	
	private static $attributes = array(
		'source' => 'string',
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
	public function getSource()
	{
		return $this->source;
	}

	/**
	 * @param string $source
	 */
	public function setSource($source)
	{
		$this->source = $source;
	}
	
}