<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdObject.php';


class XsdDocumentation extends XsdObject
{
	/**
	 * @var string
	 */
	protected $source;
	
	/**
	 * @var string
	 */
	protected $lang;
	
	private static $attributes = array(
		'source' => 'string',
		'lang' => 'string',
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
	
	/**
	 * @return string
	 */
	public function getLang()
	{
		return $this->lang;
	}

	/**
	 * @param string $lang
	 */
	public function setLang($lang)
	{
		$this->lang = $lang;
	}
	
}