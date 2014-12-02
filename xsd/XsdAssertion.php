<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdAssertion extends XsdAnnotated
{
	/**
	 * @var string
	 */
	protected $test;
	
	/**
	 * @var XsdXpathDefaultNamespace
	 */
	protected $xpathDefaultNamespace;
	
	private static $attributes = array(
		'test' => 'string',
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
	public function getTest()
	{
		return $this->test;
	}

	/**
	 * @param string $test
	 */
	public function setTest($test)
	{
		$this->test = $test;
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