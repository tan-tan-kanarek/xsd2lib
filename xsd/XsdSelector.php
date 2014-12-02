<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdSelector extends XsdAnnotated
{
	/**
	 * @var string
	 */
	protected $xpath;
	
	/**
	 * @var XsdXpathDefaultNamespace
	 */
	protected $xpathDefaultNamespace;
	
	private static $attributes = array(
		'xpath' => 'string',
		'xpathDefaultNamespace' => 'XsdXpathDefaultNamespace',
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
	public function getXpath()
	{
		return $this->xpath;
	}

	/**
	 * @param string $xpath
	 */
	public function setXpath($xpath)
	{
		$this->xpath = $xpath;
	}
	
	/**
	 * @return XsdXpathDefaultNamespace
	 */
	public function getXpathDefaultNamespace()
	{
		return $this->xpathDefaultNamespace;
	}

	/**
	 * @param XsdXpathDefaultNamespace $xpathDefaultNamespace
	 */
	public function setXpathDefaultNamespace(XsdXpathDefaultNamespace $xpathDefaultNamespace)
	{
		$this->xpathDefaultNamespace = $xpathDefaultNamespace;
	}
	
}